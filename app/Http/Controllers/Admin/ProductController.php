<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with(['category', 'images'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%")
                      ->orWhere('color', 'like', "%{$search}%")
                      ->orWhere('size', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'size' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0.01',
            'discount' => 'nullable|numeric|min:0|max:100',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'state' => 'nullable|string|in:active,inactive',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        // State & status sync
        $state = $request->input('state', 'active');
        $validated['state'] = $state;
        $validated['status'] = ($state === 'active');

        // Discount to sale_price calculation if sale_price not manually provided
        if (!empty($validated['discount']) && empty($validated['sale_price']) && !empty($validated['price'])) {
            $validated['sale_price'] = round($validated['price'] - ($validated['price'] * ($validated['discount'] / 100)), 2);
        }

        $folder = public_path('uploads/products');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Handle single main image if uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($folder, $filename);
            $validated['image'] = 'uploads/products/' . $filename;
        }

        $product = Product::create($validated);

        // Also add the main image to product_images if present
        if (!empty($product->image)) {
            $product->images()->firstOrCreate([
                'image_path' => $product->image,
            ]);
        }

        // Handle multiple gallery images
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $filename);
                    $path = 'uploads/products/' . $filename;
                    $product->images()->create([
                        'image_path' => $path,
                    ]);
                    $uploadedImages[] = $path;
                }
            }

            // If main cover image was not uploaded, set the first gallery image as main image
            if (empty($product->image) && !empty($uploadedImages)) {
                $product->update(['image' => $uploadedImages[0]]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully with all specifications!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load('images');

        $categories = Category::where('status', 1)
            ->orWhere('id', $product->category_id)
            ->orderBy('name')
            ->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($product->id),
            ],
            'sku' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'sku')->ignore($product->id),
            ],
            'description' => 'nullable|string',
            'size' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:100',
            'price' => 'required|numeric|min:0.01',
            'discount' => 'nullable|numeric|min:0|max:100',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'state' => 'nullable|string|in:active,inactive',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        // State & status sync
        $state = $request->input('state', $product->state ?? 'active');
        $validated['state'] = $state;
        $validated['status'] = ($state === 'active');

        // Discount to sale_price calculation
        if (!empty($validated['discount']) && empty($validated['sale_price']) && !empty($validated['price'])) {
            $validated['sale_price'] = round($validated['price'] - ($validated['price'] * ($validated['discount'] / 100)), 2);
        }

        $folder = public_path('uploads/products');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Single primary image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($folder, $filename);
            $validated['image'] = 'uploads/products/' . $filename;

            // Also register in product_images
            $product->images()->firstOrCreate([
                'image_path' => $validated['image'],
            ]);
        }

        $product->update($validated);

        // Multiple gallery images upload
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $filename);
                    $path = 'uploads/products/' . $filename;
                    $product->images()->create([
                        'image_path' => $path,
                    ]);
                    $uploadedImages[] = $path;
                }
            }

            if (empty($product->image) && !empty($uploadedImages)) {
                $product->update(['image' => $uploadedImages[0]]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Delete an individual gallery image.
     */
    public function destroyImage(Product $product, ProductImage $image)
    {
        if ($image->product_id === $product->id) {
            if ($image->image_path && file_exists(public_path($image->image_path))) {
                @unlink(public_path($image->image_path));
            }
            $image->delete();

            // If deleted image was the primary cover image, assign next gallery image if available
            if ($product->image === $image->image_path) {
                $next = $product->images()->first();
                $product->update(['image' => $next ? $next->image_path : null]);
            }

            return back()->with('success', 'Product image removed successfully.');
        }

        return back()->with('error', 'Unable to delete image.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
