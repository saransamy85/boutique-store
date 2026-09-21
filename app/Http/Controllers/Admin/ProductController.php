<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%");
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
        //
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
        //
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name',
            'sku' => 'required|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {

            $folder = public_path('uploads/products');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move($folder, $filename);

            $validated['image'] = 'uploads/products/' . $filename;
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
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
        //
         $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($product->id),
            ],

            'sku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('products', 'sku')->ignore($product->id),
            ],

            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {

            // Delete old image
            if ($product->image &&
                file_exists(public_path($product->image))) {

                unlink(public_path($product->image));
            }

            $folder = public_path('uploads/products');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move($folder, $filename);

            $validated['image'] = 'uploads/products/' . $filename;
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         if ($product->image &&
            file_exists(public_path($product->image))) {

            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    
    }
}
