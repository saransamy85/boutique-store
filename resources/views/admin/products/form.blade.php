<div class="content-card">

    <div class="row g-3">

        {{-- Category --}}
        <div class="col-md-6">
            <label class="form-label fw-semibold">Category *</label>

            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>

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

            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name ?? '') }}" placeholder="Enter product name" required>

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Size --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">Size</label>

            <input type="text" name="size" class="form-control @error('size') is-invalid @enderror" value="{{ old('size', $product->size ?? '') }}" placeholder="e.g. Free Size, S, M, L, XL">

            @error('size')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Color --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">Color</label>

            <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color', $product->color ?? '') }}" placeholder="e.g. Maroon, Emerald Green, Navy">

            @error('color')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- SKU (Optional / Auto-generated) --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">SKU <small class="text-muted">(Optional - auto-generated if blank)</small></label>

            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku ?? '') }}" placeholder="e.g. KUR-001">

            @error('sku')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Price --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">Regular Price (₹) *</label>

            <input type="number" id="regularPrice" name="price" step="0.01" min="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price ?? '') }}" placeholder="0.00" required>

            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Discount (Optional) --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">Discount (%) <small class="text-muted">(Optional)</small></label>

            <input type="number" id="discountPercent" name="discount" step="0.01" min="0" max="100" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount', $product->discount ?? '') }}" placeholder="e.g. 15 for 15% off">

            @error('discount')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Sale Price --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">Sale Price (₹) <small class="text-muted">(Auto-calculated or custom)</small></label>

            <input type="number" id="salePrice" name="sale_price" step="0.01" min="0" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Optional">

            @error('sale_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Stock --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">Stock Quantity *</label>

            <input type="number" name="stock" min="0" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock ?? 0) }}" required>

            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- State --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">State / Availability *</label>

            <select name="state" class="form-select @error('state') is-invalid @enderror">
                <option value="active" {{ old('state', $product->state ?? ($product->status ?? 1 ? 'active' : 'inactive')) === 'active' ? 'selected' : '' }}>
                    Active (Available for purchase)
                </option>

                <option value="inactive" {{ old('state', $product->state ?? ($product->status ?? 1 ? 'active' : 'inactive')) === 'inactive' ? 'selected' : '' }}>
                    Inactive (Hidden from catalog)
                </option>
            </select>

            @error('state')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Featured --}}
        <div class="col-md-4">
            <label class="form-label fw-semibold">Featured Product</label>

            <select name="is_featured" class="form-select">
                <option value="0" {{ (string) old('is_featured', $product->is_featured ?? 0) === '0' ? 'selected' : '' }}>
                    No
                </option>

                <option value="1" {{ (string) old('is_featured', $product->is_featured ?? 0) === '1' ? 'selected' : '' }}>
                    Yes (Show on Homepage)
                </option>
            </select>
        </div>

        {{-- Description --}}
        <div class="col-12">
            <label class="form-label fw-semibold">Description</label>

            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Enter product description, fabric details, wash care, etc.">{{ old('description', $product->description ?? '') }}</textarea>

            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Product Images (Accepts Multiple Images) --}}
        <div class="col-12">
            <label class="form-label fw-semibold">
                Product Images <span class="badge bg-secondary ms-1">Multiple Images Allowed</span>
            </label>

            <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">
            <div class="form-text">
                Hold <kbd>Ctrl</kbd> (or <kbd>Cmd</kbd>) to select multiple photos at once. Accepts JPG, PNG, WEBP up to 4MB each. The first image will be set as the primary cover photo.
            </div>

            @error('images')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            @error('images.*')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            {{-- Existing Images Gallery (if editing) --}}
            @if(isset($product) && ($product->images->count() > 0 || $product->image))
            <div class="mt-4">
                <label class="form-label fw-semibold mb-2">Current Product Images</label>

                <div class="d-flex flex-wrap gap-3 align-items-center">
                    {{-- Primary image if not in gallery collection --}}
                    @if($product->image && !$product->images->contains('image_path', $product->image))
                    <div class="position-relative border rounded p-1 bg-white shadow-sm" style="width: 120px; text-align: center;">
                        <img src="{{ asset($product->image) }}" width="110" height="110" class="rounded" style="object-fit:cover">
                        <span class="badge bg-dark position-absolute top-0 start-0 m-1">Cover</span>
                    </div>
                    @endif

                    {{-- Gallery images from product_images relation --}}
                    @foreach($product->images as $galleryImg)
                    <div class="position-relative border rounded p-1 bg-white shadow-sm" style="width: 120px; text-align: center;">
                        <img src="{{ asset($galleryImg->image_path) }}" width="110" height="110" class="rounded" style="object-fit:cover">

                        @if($product->image === $galleryImg->image_path)
                        <span class="badge bg-dark position-absolute top-0 start-0 m-1">Cover</span>
                        @endif

                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 p-0 rounded-circle" style="width: 22px; height: 22px; line-height: 20px;" title="Delete image" onclick="if(confirm('Remove this image?')) { document.getElementById('delete-img-{{ $galleryImg->id }}').submit(); }">
                            &times;
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

    </div>

    <hr class="my-4">

    <button type="submit" class="btn btn-dark">
        <i class="bi bi-check-circle me-1"></i>
        {{ isset($product) ? 'Update Product' : 'Save Product' }}
    </button>

    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary ms-2">
        Cancel
    </a>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceInput = document.getElementById('regularPrice');
        const discountInput = document.getElementById('discountPercent');
        const salePriceInput = document.getElementById('salePrice');

        function recalculate() {
            const price = parseFloat(priceInput.value) || 0;
            const discount = parseFloat(discountInput.value) || 0;

            if (price > 0 && discount > 0 && discount <= 100) {
                const discounted = price - (price * (discount / 100));
                salePriceInput.value = discounted.toFixed(2);
            }
        }

        if (priceInput && discountInput && salePriceInput) {
            discountInput.addEventListener('input', recalculate);
            priceInput.addEventListener('input', function() {
                if (discountInput.value) {
                    recalculate();
                }
            });
        }
    });
</script>

{{-- Hidden delete forms for gallery images --}}
@if(isset($product) && $product->images->count() > 0)
    @foreach($product->images as $galleryImg)
    <form id="delete-img-{{ $galleryImg->id }}" action="{{ route('admin.products.images.destroy', [$product->id, $galleryImg->id]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    @endforeach
@endif
