@csrf

<div class="row g-3">

    {{-- Size --}}
    <div class="col-md-6">

        <label class="form-label">Size</label>

        <select name="size" class="form-select">

            <option value="">No Size</option>

            @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL', 'Free Size'] as $size)

            <option value="{{ $size }}" @selected(old('size', $variant->size ?? '') == $size)>

                {{ $size }}

            </option>

            @endforeach

        </select>

        @error('size')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- Color --}}
    <div class="col-md-6">

        <label class="form-label">Color</label>

        <input type="text" name="color" class="form-control" placeholder="Example: Emerald Green" value="{{ old('color', $variant->color ?? '') }}">

        @error('color')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- SKU --}}
    <div class="col-md-6">

        <label class="form-label">Variant SKU *</label>

        <input type="text" name="sku" class="form-control" placeholder="Example: FK-M-GRN" value="{{ old('sku', $variant->sku ?? '') }}" required>

        @error('sku')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- Price --}}
    <div class="col-md-6">

        <label class="form-label">Variant Price (₹)</label>

        <input type="number" name="price" class="form-control" step="0.01" min="0" placeholder="Leave blank to use product price" value="{{ old('price', $variant->price ?? '') }}">

        @error('price')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- Stock --}}
    <div class="col-md-6">

        <label class="form-label">Stock Quantity *</label>

        <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', $variant->stock ?? 0) }}" required>

        @error('stock')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- Status --}}
    <div class="col-md-6">

        <label class="form-label">Status</label>

        <select name="is_active" class="form-select">

            <option value="1" @selected(old('is_active', $variant->is_active ?? 1) == 1)>
                Active
            </option>

            <option value="0" @selected(old('is_active', $variant->is_active ?? 1) == 0)>
                Inactive
            </option>

        </select>

    </div>

</div>

<div class="mt-4">

    <button type="submit" class="btn btn-primary">
        Save Variant
    </button>

    <a href="{{ route('admin.products.variants.index', $product->id) }}" class="btn btn-secondary">

        Cancel

    </a>

</div>
