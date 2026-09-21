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
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $product->variants()->create($validated);

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
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $variant->update($validated);

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
