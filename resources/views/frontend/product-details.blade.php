@extends('frontend.layouts.app')

@section('content')

<style>
    .product-details-section {
        background: #fff;
        padding: 60px 0;
    }

    .product-image-box {
        background: #FAF8F1;
        border-radius: 12px;
        overflow: hidden;
    }

    .product-main-image {
        width: 100%;
        height: 580px;
        object-fit: contain;
        padding: 20px;
    }

    .variant-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 8px;
        background: #FAF8F1;
        transition: .3s;
    }

    .variant-thumbnail.active, .variant-thumbnail:hover {
        border-color: #003B32;
    }

    .product-info {
        padding: 20px 15px 20px 45px;
    }

    .product-breadcrumb {
        font-size: 13px;
        color: #888;
        margin-bottom: 25px;
    }

    .product-breadcrumb a {
        color: #003B32;
        text-decoration: none;
    }

    .product-title {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
        color: #003B32;
        margin-bottom: 12px;
    }

    .product-price {
        font-size: 27px;
        font-weight: 600;
        color: #003B32;
        margin: 20px 0;
    }

    .product-old-price {
        color: #999;
        font-size: 17px;
        text-decoration: line-through;
        margin-left: 10px;
    }

    .product-description {
        color: #777;
        font-size: 15px;
        line-height: 1.9;
        margin: 25px 0;
    }

    .product-meta {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
    }

    .product-meta strong {
        color: #003B32;
    }

    .variant-label {
        font-size: 14px;
        font-weight: 600;
        color: #242424;
        margin-bottom: 12px;
        display: block;
    }

    .variant-color-btn,
    .variant-size-btn {
        border: 1px solid #ddd;
        background: #fff;
        color: #333;
        padding: 10px 18px;
        cursor: pointer;
        transition: .3s;
        border-radius: 5px;
        font-size: 14px;
    }

    .variant-color-btn:hover,
    .variant-size-btn:hover {
        border-color: #003B32;
        color: #003B32;
    }

    .variant-color-btn.active,
    .variant-size-btn.active {
        background: #003B32;
        color: #fff;
        border-color: #D4AF37;
    }

    .variant-color-btn:disabled,
    .variant-size-btn:disabled {
        opacity: .35;
        cursor: not-allowed;
        text-decoration: line-through;
    }

    .product-quantity {
        width: 100px;
        height: 48px;
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .product-action-btn {
        height: 50px;
        padding: 0 30px;
        background: #003B32;
        color: #fff;
        border: 1px solid #003B32;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: .3s;
    }

    .product-action-btn:hover:not(:disabled) {
        background: #D4AF37;
        color: #003B32;
        border-color: #D4AF37;
    }

    .product-action-btn:disabled {
        background: #999;
        border-color: #999;
        cursor: not-allowed;
    }

    .product-divider {
        border-top: 1px solid #eee;
        margin: 25px 0;
    }

    .product-benefits {
        background: #FAF8F1;
        border-left: 3px solid #D4AF37;
        padding: 18px;
        margin-top: 25px;
        font-size: 13px;
        color: #555;
        border-radius: 5px;
    }

    .stock-available {
        color: #198754;
    }

    .stock-unavailable {
        color: #dc3545;
    }

    @media (max-width: 991px) {
        .product-info {
            padding: 30px 5px;
        }

        .product-main-image {
            height: 450px;
        }

        .product-title {
            font-size: 30px;
        }
    }

    @media (max-width: 576px) {
        .product-details-section {
            padding: 25px 0;
        }

        .product-main-image {
            height: 350px;
        }

        .product-title {
            font-size: 28px;
        }

        .product-action-btn {
            padding: 0 18px;
        }
    }

</style>

<section class="product-details-section">

    <div class="container">

        {{-- Breadcrumb --}}
        <div class="product-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            /
            <a href="{{ route('shop') }}">Shop</a>
            /
            <span>{{ $product->name }}</span>
        </div>

        <div class="row align-items-start">

            {{-- Product Image --}}
            <div class="col-lg-6">

                <div class="product-image-box">

                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-main-image" id="mainProductImage">

                </div>
                
                <div class="d-flex flex-wrap gap-2 mt-3" id="variantThumbnailsContainer">
                    @php
                        // Collect all unique images (direct product images + variant images)
                        $allImages = collect($product->all_images);
                        if($product->variants) {
                            foreach($product->variants as $variant) {
                                if($variant->images) {
                                    foreach($variant->images as $img) {
                                        $allImages->push($img->image_path);
                                    }
                                }
                            }
                        }
                        $allImages = $allImages->filter()->unique()->values();
                    @endphp

                    @foreach($allImages as $index => $imagePath)
                        <img src="{{ asset($imagePath) }}" class="variant-thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="document.getElementById('mainProductImage').src=this.src; window.updateActiveThumbnail(this)">
                    @endforeach
                </div>

            </div>

            {{-- Product Information --}}
            <div class="col-lg-6">

                <div class="product-info">

                    <span class="text-uppercase text-muted small">
                        Kathirazhagi Boutique Collection
                    </span>

                    <h1 class="product-title mt-3">
                        {{ $product->name }}
                    </h1>

                    {{-- Product Price --}}
                    <div class="d-flex align-items-baseline gap-2 mb-2">
                        <h3 id="productPrice" class="product-price mb-0">
                            ₹{{ number_format($product->effective_price, 2) }}
                        </h3>

                        @if(($product->sale_price !== null && $product->sale_price < $product->price) || ($product->discount !== null && $product->discount > 0))
                        <span class="product-old-price">
                            ₹{{ number_format($product->price, 2) }}
                        </span>
                        <span class="badge bg-danger">
                            {{ $product->discount_percent }}% OFF
                        </span>
                        @endif
                    </div>

                    {{-- Product Description --}}
                    @if($product->description)
                    <div class="product-description">
                        {{ $product->description }}
                    </div>
                    @endif

                    {{-- Variant Selection --}}
                    @if($product->variants->count() > 0)

                    {{-- Color Selection --}}
                    @if($product->variants->pluck('color')->filter()->unique()->count() > 0)

                    <div class="mb-4">

                        <label class="variant-label">
                            Color:
                            <span id="selectedColor" class="text-muted">
                                Select Color
                            </span>
                        </label>

                        <div class="d-flex flex-wrap gap-2">

                            @foreach($product->variants->pluck('color')->filter()->unique() as $color)

                            <button type="button" class="variant-color-btn" data-color="{{ $color }}">
                                {{ $color }}
                            </button>

                            @endforeach

                        </div>

                    </div>

                    @endif

                    {{-- Size Selection --}}
                    @if($product->variants->pluck('size')->filter()->unique()->count() > 0)

                    <div class="mb-4">

                        <label class="variant-label">
                            Size:
                            <span id="selectedSize" class="text-muted">
                                Select Size
                            </span>
                        </label>

                        <div class="d-flex flex-wrap gap-2">

                            @foreach($product->variants->pluck('size')->filter()->unique() as $size)

                            <button type="button" class="variant-size-btn" data-size="{{ $size }}">
                                {{ $size }}
                            </button>

                            @endforeach

                        </div>

                    </div>

                    @endif

                    {{-- Stock Status --}}
                    <div class="mb-3">

                        <span class="fw-semibold">
                            Availability:
                        </span>

                        <span id="stockStatus" class="text-muted">
                            Please select options
                        </span>

                    </div>

                    @else

                    {{-- Direct Product Size & Color (without variants) --}}
                    <div class="d-flex flex-wrap gap-3 mb-3">
                        @if($product->size)
                        <div>
                            <span class="text-muted small d-block mb-1">Size</span>
                            <span class="badge bg-light text-dark border px-3 py-2 fs-6 fw-normal">{{ $product->size }}</span>
                        </div>
                        @endif

                        @if($product->color)
                        <div>
                            <span class="text-muted small d-block mb-1">Color</span>
                            <span class="badge bg-light text-dark border px-3 py-2 fs-6 fw-normal">{{ $product->color }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <span class="fw-semibold">Availability:</span>
                        @if($product->stock > 0)
                        <span class="stock-available ms-1">In Stock ({{ $product->stock }} available)</span>
                        @else
                        <span class="stock-unavailable ms-1">Out of Stock</span>
                        @endif
                    </div>

                    @endif

                    <div class="product-divider"></div>

                    {{-- Add to Cart --}}
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm">

                        @csrf

                        {{-- Selected Variant ID --}}
                        <input type="hidden" name="variant_id" id="selectedVariantId">

                        {{-- Quantity --}}
                        <div class="d-flex align-items-center gap-3 mb-3">

                            <label for="quantity" class="fw-semibold">
                                Qty:
                            </label>

                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control product-quantity">

                        </div>

                        {{-- Add to Bag Button --}}
                        <button type="submit" id="addToCartBtn" class="btn product-action-btn w-100" {{ $product->variants->count() > 0 ? 'disabled' : '' }}>

                            ADD TO BAG

                        </button>

                    </form>

                    {{-- Product Benefits --}}
                    <div class="product-benefits">

                        <div class="mb-2">
                            ✓ Carefully selected boutique styles
                        </div>

                        <div class="mb-2">
                            ✓ Secure shopping experience
                        </div>

                        <div>
                            ✓ Made for your everyday elegance
                        </div>

                    </div>

                    <div class="product-divider"></div>

                    {{-- Product Category --}}
                    <div class="product-meta">

                        <strong>Category:</strong>

                        {{ $product->category->name ?? 'Fashion' }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- Variant Selection Script --}}
@if($product->variants->count() > 0)

<script>
    document.addEventListener('DOMContentLoaded', function() {

        @php
            $mappedVariants = $product->variants->map(function($variant) use($product) {
                return [
                    'id' => $variant->id,
                    'size' => $variant->size,
                    'color' => $variant->color,
                    'price' => $variant->price ?? $product->sale_price ?? $product->price,
                    'stock' => (int) $variant->stock,
                    'images' => $variant->images->pluck('image_path')->map(fn($path) => asset($path))->toArray()
                ];
            })->values();
        @endphp
        const variants = @json($mappedVariants);

        const colorButtons = document.querySelectorAll('.variant-color-btn');
        const sizeButtons = document.querySelectorAll('.variant-size-btn');

        const selectedColorText = document.getElementById('selectedColor');
        const selectedSizeText = document.getElementById('selectedSize');

        const selectedVariantInput = document.getElementById('selectedVariantId');

        const productPrice = document.getElementById('productPrice');
        const stockStatus = document.getElementById('stockStatus');

        const quantityInput = document.getElementById('quantity');
        const addToCartBtn = document.getElementById('addToCartBtn');

        const hasColors = colorButtons.length > 0;
        const hasSizes = sizeButtons.length > 0;

        let selectedColor = null;
        let selectedSize = null;

        function findSelectedVariant() {

            return variants.find(function(variant) {

                return (!hasColors || variant.color === selectedColor) &&
                    (!hasSizes || variant.size === selectedSize);

            });
        }

        function updateVariant() {

            const variant = findSelectedVariant();

            selectedVariantInput.value = '';

            // Update Images
            let matchingVariants = variants;
            if (selectedColor) {
                matchingVariants = matchingVariants.filter(v => v.color === selectedColor);
            }
            if (selectedSize) {
                matchingVariants = matchingVariants.filter(v => v.size === selectedSize);
            }
            
            let imagesToShow = [];
            matchingVariants.forEach(v => {
                if (v.images && v.images.length > 0) {
                    imagesToShow.push(...v.images);
                }
            });
            
            imagesToShow = [...new Set(imagesToShow)]; // Deduplicate
            
            if (imagesToShow.length === 0) {
                imagesToShow = ['{{ asset($product->image) }}'];
            }
            
            const thumbnailsContainer = document.getElementById('variantThumbnailsContainer');
            const mainImage = document.getElementById('mainProductImage');
            
            thumbnailsContainer.innerHTML = '';
            mainImage.src = imagesToShow[0];
            
            imagesToShow.forEach(function(imgSrc, index) {
                const img = document.createElement('img');
                img.src = imgSrc;
                img.className = 'variant-thumbnail' + (index === 0 ? ' active' : '');
                img.onclick = function() {
                    mainImage.src = this.src;
                    window.updateActiveThumbnail(this);
                };
                thumbnailsContainer.appendChild(img);
            });

            if (!variant) {

                stockStatus.textContent = 'Please select available options';
                stockStatus.className = 'text-muted';

                addToCartBtn.disabled = true;

                updateAvailableOptions();
                return;
            }

            selectedVariantInput.value = variant.id;

            productPrice.textContent = '₹' + Number(variant.price).toLocaleString('en-IN', {
                minimumFractionDigits: 2
                , maximumFractionDigits: 2
            });

            quantityInput.value = 1;
            quantityInput.max = variant.stock;

            if (variant.stock > 0) {

                stockStatus.textContent = 'In Stock (' + variant.stock + ' available)';
                stockStatus.className = 'stock-available';

                addToCartBtn.disabled = false;

            } else {

                stockStatus.textContent = 'Out of Stock';
                stockStatus.className = 'stock-unavailable';

                addToCartBtn.disabled = true;
            }

            updateAvailableOptions();
        }

        window.updateActiveThumbnail = function(clickedElement) {
            document.querySelectorAll('.variant-thumbnail').forEach(function(el) {
                el.classList.remove('active');
            });
            clickedElement.classList.add('active');
        };

        function updateAvailableOptions() {

            colorButtons.forEach(function(button) {

                const color = button.dataset.color;

                const available = variants.some(function(variant) {

                    return variant.color === color &&
                        (!selectedSize || variant.size === selectedSize) &&
                        variant.stock > 0;

                });

                button.disabled = !available;

            });

            sizeButtons.forEach(function(button) {

                const size = button.dataset.size;

                const available = variants.some(function(variant) {

                    return variant.size === size &&
                        (!selectedColor || variant.color === selectedColor) &&
                        variant.stock > 0;

                });

                button.disabled = !available;

            });
        }

        colorButtons.forEach(function(button) {

            button.addEventListener('click', function() {

                selectedColor = this.dataset.color;

                selectedColorText.textContent = selectedColor;

                colorButtons.forEach(btn => btn.classList.remove('active'));

                this.classList.add('active');

                // Reset size if the combination is unavailable
                if (selectedSize && !findSelectedVariant()) {

                    selectedSize = null;

                    selectedSizeText.textContent = 'Select Size';

                    sizeButtons.forEach(btn => btn.classList.remove('active'));
                }

                updateVariant();
            });
        });

        sizeButtons.forEach(function(button) {

            button.addEventListener('click', function() {

                selectedSize = this.dataset.size;

                selectedSizeText.textContent = selectedSize;

                sizeButtons.forEach(btn => btn.classList.remove('active'));

                this.classList.add('active');

                // Reset color if the combination is unavailable
                if (selectedColor && !findSelectedVariant()) {

                    selectedColor = null;

                    selectedColorText.textContent = 'Select Color';

                    colorButtons.forEach(btn => btn.classList.remove('active'));
                }

                updateVariant();
            });
        });

        quantityInput.addEventListener('change', function() {

            const variant = findSelectedVariant();

            if (!variant) return;

            let quantity = parseInt(this.value) || 1;

            quantity = Math.max(1, Math.min(quantity, variant.stock));

            this.value = quantity;
        });

        updateAvailableOptions();

    });

</script>

@endif

@endsection
