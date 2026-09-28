<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Validation\Rule;

class ProductVariantController extends Controller
{
    //
    public function index(Product $product)
    {
        $variants = $product->variants()
            ->latest()
            ->paginate(15);

        return view(
            'admin.products.variants.index',
            compact('product', 'variants')
        );
    }

    public function create(Product $product)
    {
        return view(
            'admin.products.variants.create',
            compact('product')
        );
    }

    public function store(Request $request, Product $product)
    {
        if (!$request->filled('sku')) {
            $generatedSku = $product->sku;
            if ($request->color) $generatedSku .= '-' . \Illuminate\Support\Str::slug($request->color);
            if ($request->size) $generatedSku .= '-' . \Illuminate\Support\Str::slug($request->size);
            
            if (\App\Models\ProductVariant::where('sku', $generatedSku)->exists()) {
                $generatedSku .= '-' . strtoupper(\Illuminate\Support\Str::random(4));
            }
            $request->merge(['sku' => $generatedSku]);
        }

        $validated = $request->validate([
            'size' => ['nullable', 'string', 'max:30'],
            'color' => ['nullable', 'string', 'max:50'],

            'sku' => [
                'required',
                'string',
                'max:100',
                'unique:product_variants,sku',
            ],

            'price' => ['nullable', 'numeric', 'min:0'],

            'stock' => ['required', 'integer', 'min:0'],

            'is_active' => ['nullable', 'boolean'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $variant = $product->variants()->create($validated);

        if ($request->hasFile('images')) {
            $folder = public_path('uploads/products/variants');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($folder, $filename);
                $variant->images()->create([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/products/variants/' . $filename,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.variants.index', $product->id)
            ->with('success', 'Product variant added successfully.');
    }

    public function edit(Product $product, ProductVariant $variant)
    {
        abort_unless($variant->product_id === $product->id, 404);

        return view(
            'admin.products.variants.edit',
            compact('product', 'variant')
        );
    }

    public function update(
        Request $request,
        Product $product,
        ProductVariant $variant
    ) {
        abort_unless($variant->product_id === $product->id, 404);

        if (!$request->filled('sku')) {
            $generatedSku = $product->sku;
            if ($request->color) $generatedSku .= '-' . \Illuminate\Support\Str::slug($request->color);
            if ($request->size) $generatedSku .= '-' . \Illuminate\Support\Str::slug($request->size);
            
            if (\App\Models\ProductVariant::where('sku', $generatedSku)->where('id', '!=', $variant->id)->exists()) {
                $generatedSku .= '-' . strtoupper(\Illuminate\Support\Str::random(4));
            }
            $request->merge(['sku' => $generatedSku]);
        }

        $validated = $request->validate([
            'size' => ['nullable', 'string', 'max:30'],
            'color' => ['nullable', 'string', 'max:50'],

            'sku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('product_variants', 'sku')
                    ->ignore($variant->id),
            ],

            'price' => ['nullable', 'numeric', 'min:0'],

            'stock' => ['required', 'integer', 'min:0'],

            'is_active' => ['nullable', 'boolean'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $variant->update($validated);

        if ($request->hasFile('images')) {
            $folder = public_path('uploads/products/variants');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($folder, $filename);
                $variant->images()->create([
                    'product_id' => $product->id,
                    'image_path' => 'uploads/products/variants/' . $filename,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.variants.index', $product->id)
            ->with('success', 'Product variant updated successfully.');
    }

    public function destroy(Product $product, ProductVariant $variant)
    {
        abort_unless($variant->product_id === $product->id, 404);

        $variant->delete();

        return redirect()
            ->route('admin.products.variants.index', $product->id)
            ->with('success', 'Product variant deleted successfully.');
    }
}
