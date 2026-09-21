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

                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-main-image">

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
                    <h3 id="productPrice" class="product-price">

                        ₹{{ number_format($product->sale_price ?? $product->price, 2) }}

                    </h3>

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

                    <p class="text-muted">
                        Standard product
                    </p>

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

            if (!variant) {

                stockStatus.textContent = 'Please select available options';
                stockStatus.className = 'text-muted';

                addToCartBtn.disabled = true;

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
