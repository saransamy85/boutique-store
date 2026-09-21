<div class="content-card">

    <div class="row g-3">

        {{-- Category --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Category *</label>

            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">

                <option value="">Select Category</option>

                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (string) old('category_id', $product->category_id ?? '') === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach

            </select>

            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Name --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Product Name *</label>

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name ?? '') }}" placeholder="Enter product name">

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- SKU --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">SKU *</label>

            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku ?? '') }}" placeholder="Example: KUR-001">

            @error('sku')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Stock --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Stock Quantity *</label>

            <input type="number" name="stock" min="0" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock ?? 0) }}">

            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Price --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Regular Price (₹) *</label>

            <input type="number" name="price" step="0.01" min="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price ?? '') }}">

            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Sale Price --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Sale Price (₹)</label>

            <input type="number" name="sale_price" step="0.01" min="0" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Optional">

            @error('sale_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="col-12">
            <label class="form-label fw-semibold">Description</label>

            <textarea name="description" rows="4" class="form-control" placeholder="Enter product description">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        {{-- Product Image --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Product Image</label>

            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="form-control @error('image') is-invalid @enderror">

            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if(isset($product) && $product->image)
            <div class="mt-3">
                <img src="{{ asset($product->image) }}" width="100" height="100" class="rounded" style="object-fit:cover">

                <p class="small text-muted mt-1">Current image</p>
            </div>
            @endif
        </div>

        {{-- Status --}}
        <div class="col-md-3">
            <label class="form-label fw-semibold">Status *</label>

            <select name="status" class="form-select">
                <option value="1" {{ (string) old('status', $product->status ?? 1) === '1' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0" {{ (string) old('status', $product->status ?? 1) === '0' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        {{-- Featured --}}
        <div class="col-md-3">
            <label class="form-label fw-semibold">Featured Product</label>

            <select name="is_featured" class="form-select">
                <option value="0" {{ (string) old('is_featured', $product->is_featured ?? 0) === '0' ? 'selected' : '' }}>
                    No
                </option>

                <option value="1" {{ (string) old('is_featured', $product->is_featured ?? 0) === '1' ? 'selected' : '' }}>
                    Yes
                </option>
            </select>
        </div>

    </div>

    <hr class="my-4">

    <button type="submit" class="btn btn-dark">
        <i class="bi bi-check-circle me-1"></i>
        {{ isset($product) ? 'Update Product' : 'Save Product' }}
    </button>

    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
        Cancel
    </a>

</div>
