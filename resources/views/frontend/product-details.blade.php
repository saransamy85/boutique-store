@extends('frontend.layouts.app')

@php
$brand = 'Kathirazhagi Boutique';
$hasDiscount = ($product->sale_price !== null && $product->sale_price < $product->price) || ($product->discount !== null && $product->discount > 0);
$discountPercent = $product->discount_percent;
$showDiscountBadge = $hasDiscount && $discountPercent >= 1;
@endphp

@section('title', $product->name . ' | Haute Atelier | ' . $brand)
@section('meta_description', Str::limit(strip_tags($product->description ?? 'Discover ' . $product->name . ' at ' . $brand . '. Handloom pure silk weaves and artisanal designer silhouettes.'), 155))

@section('content')

{{-- ===================================================
    1. HAUTE EDITORIAL BREADCRUMB & HEADER BANNER
=================================================== --}}
<section class="boutique-details-hero position-relative overflow-hidden">
    {{-- Ambient Radiant Glow Orbs --}}
    <div class="details-ambient-glow glow-gold"></div>
    <div class="details-ambient-glow glow-berry"></div>
    <div class="details-grid-pattern"></div>

    <div class="container position-relative z-2 py-4">
        {{-- Luxury Breadcrumb Trail --}}
        <nav aria-label="breadcrumb" data-motion="fade-down" data-motion-delay="100">
            <ol class="breadcrumb details-luxury-breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('shop') }}">
                        Haute Catalogue
                    </a>
                </li>
                @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}">
                        {{ $product->category->name }}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item active text-gold fw-semibold" aria-current="page">
                    {{ Str::limit($product->name, 35) }}
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- ===================================================
    2. MAIN PRODUCT DETAILS SHOWCASE SECTION
=================================================== --}}
<section class="product-details-luxury-section py-5 position-relative">
    <div class="container">
        <div class="row align-items-start g-4 g-lg-5">

            {{-- Left Column: Interactive Haute Media Showcase --}}
            <div class="col-lg-6" data-motion="fade-right" data-motion-duration="900">
                <div class="product-gallery-sticky">
                    {{-- Main Visual Display Box with 3D Tilt & Frame --}}
                    <div class="product-main-showcase position-relative overflow-hidden" data-tilt="true">
                        {{-- Sale / Featured Badges --}}
                        @if($showDiscountBadge)
                        <div class="luxury-detail-offer-badge pulse-ring-glow">
                            <span>EXTRA {{ $discountPercent }}% OFF</span>
                        </div>
                        @elseif($product->is_featured)
                        <div class="luxury-detail-featured-badge">
                            <i class="bi bi-stars me-1 text-gold"></i> ROYAL EDIT
                        </div>
                        @endif

                        {{-- Silk Mark Purity Seal Watermark --}}
                        <div class="authenticity-watermark">
                            <i class="bi bi-patch-check-fill text-gold me-1"></i>
                            <span>100% Handloom Certified</span>
                        </div>

                        {{-- Main Interactive Image --}}
                        <div class="main-image-wrap">
                            <img src="{{ asset($product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="product-main-image img-fluid" 
                                 id="mainProductImage">
                        </div>

                        {{-- Gold Framing Hairline Overlay --}}
                        <div class="showcase-gold-frame"></div>
                    </div>

                    {{-- Variant & Gallery Thumbnails Carousel --}}
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

                    @if($allImages->count() > 1)
                    <div class="gallery-thumbnails-strip mt-3" id="variantThumbnailsContainer">
                        @foreach($allImages as $index => $imagePath)
                        <div class="thumb-card {{ $index === 0 ? 'active' : '' }}" 
                             onclick="switchShowcaseImage('{{ asset($imagePath) }}', this, '{{ $imagePath }}')">
                            <img src="{{ asset($imagePath) }}" 
                                 alt="Thumbnail {{ $index + 1 }}" 
                                 class="variant-thumbnail-img">
                            <div class="thumb-gold-indicator"></div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div id="variantThumbnailsContainer" class="d-none"></div>
                    @endif

                    {{-- Artisan Heritage Guarantee Micro-Bar --}}
                    <div class="artisan-guarantee-pills d-flex flex-wrap align-items-center justify-content-between gap-2 mt-4 p-3 rounded-4 bg-cream-silk border border-gold-light">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-gem text-gold fs-5"></i>
                            <span class="small fw-semibold text-purple-deep">Pure Mulberry Silk</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-box-seam text-gold fs-5"></i>
                            <span class="small fw-semibold text-purple-deep">Luxury Boutique Packaging</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-airplane text-gold fs-5"></i>
                            <span class="small fw-semibold text-purple-deep">Worldwide Delivery</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Haute Silhouette Specifications & Cart Action --}}
            <div class="col-lg-6" data-motion="fade-left" data-motion-duration="900">
                <div class="product-editorial-panel ps-lg-3">

                    {{-- Royal Atelier Eyebrow --}}
                    <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                        <div class="detail-royal-pill">
                            <i class="bi bi-stars text-gold me-1"></i>
                            <span>{{ strtoupper($product->category->name ?? 'HAUTE ATELIER') }} CREATION</span>
                        </div>
                        @if($product->sku)
                        <span class="sku-chip text-muted small">
                            SKU: <strong>{{ $product->sku }}</strong>
                        </span>
                        @endif
                    </div>

                    {{-- Product Title --}}
                    <h1 class="product-haute-title mb-3">
                        {{ $product->name }}
                    </h1>

                    {{-- Pricing & Discount Strip --}}
                    <div class="pricing-headline-strip d-flex align-items-baseline flex-wrap gap-3 mb-4 pb-3 border-bottom border-gold-light">
                        <h2 class="current-price-headline mb-0" id="productPrice">
                            ₹{{ number_format($product->effective_price, 2) }}
                        </h2>

                        @if($showDiscountBadge)
                        <span class="original-price-strike" id="productOldPrice">
                            ₹{{ number_format($product->price, 2) }}
                        </span>
                        <span class="savings-ribbon-badge" id="productSavingsBadge">
                            Save {{ $discountPercent }}%
                        </span>
                        @else
                        <span class="original-price-strike d-none" id="productOldPrice"></span>
                        <span class="savings-ribbon-badge d-none" id="productSavingsBadge"></span>
                        @endif

                        <span class="tax-inclusive-tag text-muted small ms-auto">
                            <i class="bi bi-check-circle-fill text-gold me-1"></i> Inclusive of all taxes
                        </span>
                    </div>

                    {{-- Product Description --}}
                    @if($product->description)
                    <div class="product-editorial-description mb-4">
                        <p class="description-text mb-0">
                            {{ $product->description }}
                        </p>
                    </div>
                    @endif

                    {{-- Dynamic Variants Section --}}
                    @if($product->variants->count() > 0)

                        {{-- Color Selection --}}
                        @if($product->variants->pluck('color')->filter()->unique()->count() > 0)
                        <div class="variant-group-wrap mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="variant-group-label mb-0">
                                    <i class="bi bi-palette text-gold me-1"></i> Color Hue:
                                    <span id="selectedColor" class="selected-val-badge">Select Shade</span>
                                </label>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->variants->pluck('color')->filter()->unique() as $color)
                                <button type="button" 
                                        class="variant-color-btn magnetic-btn" 
                                        data-color="{{ $color }}">
                                    <span class="btn-color-dot"></span>
                                    <span>{{ $color }}</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Size Selection --}}
                        @if($product->variants->pluck('size')->filter()->unique()->count() > 0)
                        <div class="variant-group-wrap mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="variant-group-label mb-0">
                                    <i class="bi bi-rulers text-gold me-1"></i> Silhouette Size:
                                    <span id="selectedSize" class="selected-val-badge">Select Size</span>
                                </label>
                                <a href="https://wa.me/919944747683?text={{ urlencode('Hello Kathirazhagi Atelier, I need size guidance for: ' . $product->name) }}" 
                                   target="_blank" 
                                   class="size-guide-link small">
                                    <i class="bi bi-question-circle me-1"></i> Need Size Guidance?
                                </a>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->variants->pluck('size')->filter()->unique() as $size)
                                <button type="button" 
                                        class="variant-size-btn magnetic-btn" 
                                        data-size="{{ $size }}">
                                    {{ $size }}
                                </button>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Dynamic Stock Status Pill --}}
                        <div class="stock-indicator-strip mb-4">
                            <span class="stock-label text-muted small fw-semibold me-2">Availability:</span>
                            <span id="stockStatus" class="stock-pill stock-pending">
                                <i class="bi bi-info-circle me-1"></i> Please choose your color & size options
                            </span>
                        </div>

                    @else
                        {{-- Direct Attributes (No Variants) --}}
                        <div class="direct-attributes-wrap d-flex flex-wrap gap-3 mb-4">
                            @if($product->size)
                            <div class="attribute-tile">
                                <span class="attribute-label text-muted small d-block">Size</span>
                                <span class="attribute-val fw-semibold text-purple-deep">{{ $product->size }}</span>
                            </div>
                            @endif

                            @if($product->color)
                            <div class="attribute-tile">
                                <span class="attribute-label text-muted small d-block">Color Hue</span>
                                <span class="attribute-val fw-semibold text-purple-deep">{{ $product->color }}</span>
                            </div>
                            @endif
                        </div>

                        {{-- Direct Stock Status --}}
                        <div class="stock-indicator-strip mb-4">
                            <span class="stock-label text-muted small fw-semibold me-2">Availability:</span>
                            @if($product->stock > 0)
                            <span class="stock-pill stock-available">
                                <i class="bi bi-check-circle-fill me-1"></i> In Stock ({{ $product->stock }} handcrafted pieces available)
                            </span>
                            @else
                            <span class="stock-pill stock-unavailable">
                                <i class="bi bi-x-circle-fill me-1"></i> Currently Reserved / Out of Stock
                            </span>
                            @endif
                        </div>
                    @endif

                    {{-- Add to Bag & Action Controls Form --}}
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm" class="mb-4">
                        @csrf
                        <input type="hidden" name="variant_id" id="selectedVariantId">
                        <input type="hidden" name="selected_image" id="selectedImageInput" value="{{ $product->image }}">

                        <div class="action-bar-row d-flex flex-wrap align-items-center gap-3">
                            {{-- Luxury Quantity Stepper --}}
                            <div class="quantity-stepper-box d-flex align-items-center">
                                <button type="button" class="qty-btn" id="qtyMinusBtn" aria-label="Decrease quantity">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" 
                                       name="quantity" 
                                       id="quantity" 
                                       value="1" 
                                       min="1" 
                                       class="qty-input form-control text-center" 
                                       readonly>
                                <button type="button" class="qty-btn" id="qtyPlusBtn" aria-label="Increase quantity">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>

                            {{-- Magnetic Add to Bag Button --}}
                            <div class="flex-grow-1">
                                <button type="submit" 
                                        id="addToCartBtn" 
                                        class="btn-royal-gold-cart magnetic-btn w-100" 
                                        {{ $product->variants->count() > 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-bag-plus me-2 fs-5"></i>
                                    <span>ADD TO BAG</span>
                                    <div class="btn-shimmer-sweep"></div>
                                </button>
                            </div>

                            {{-- Wishlist Heart Button --}}
                            <div class="wishlist-btn-wrap">
                                <button type="button" 
                                        class="btn-luxury-wishlist magnetic-btn" 
                                        title="Save to Wishlist"
                                        onclick="handleProductDetailWishlist(this, '{{ route('wishlist.add', $product->id) }}')">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- WhatsApp Stylist Concierge Strip --}}
                    <div class="concierge-touchpoint-box d-flex align-items-center justify-content-between p-3 rounded-4 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="concierge-icon-circle">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-purple-deep">Personal Stylist Assistance</h6>
                                <p class="mb-0 text-muted small">Need matching blouse stitching or color advice?</p>
                            </div>
                        </div>
                        <a href="https://wa.me/919944747683?text={{ urlencode('Hello Kathirazhagi Boutique, I would like styling advice and blouse stitching for: ' . $product->name . ' (' . url()->current() . ')') }}" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="btn-wa-consult magnetic-btn">
                            <span>Chat on WhatsApp</span>
                            <i class="bi bi-arrow-right-short fs-5 ms-1"></i>
                        </a>
                    </div>

                    {{-- Accordion for Artisan Story, Care & Shipping Details --}}
                    <div class="accordion luxury-accordion" id="productDetailsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingCraft">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCraft" aria-expanded="true" aria-controls="collapseCraft">
                                    <i class="bi bi-flower1 text-gold me-2"></i> Handloom Weave & Craftsmanship
                                </button>
                            </h2>
                            <div id="collapseCraft" class="accordion-collapse collapse show" aria-labelledby="headingCraft" data-bs-parent="#productDetailsAccordion">
                                <div class="accordion-body text-muted small">
                                    Crafted with pride by skilled hereditary artisans using traditional South Indian wooden loom drapes, authentic pure golden zari borders, and featherlight breathable silk textures designed to drape with graceful majesty.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingCare">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCare" aria-expanded="false" aria-controls="collapseCare">
                                    <i class="bi bi-droplet-half text-gold me-2"></i> Garment Care Instructions
                                </button>
                            </h2>
                            <div id="collapseCare" class="accordion-collapse collapse" aria-labelledby="headingCare" data-bs-parent="#productDetailsAccordion">
                                <div class="accordion-body text-muted small">
                                    Dry clean recommended for the first 3 washes to preserve natural silk sheen and golden zari radiance. Store folded inside breathable muslin cloth away from direct sunlight.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingShipping">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShipping" aria-expanded="false" aria-controls="collapseShipping">
                                    <i class="bi bi-truck text-gold me-2"></i> Complimentary Shipping & Return Terms
                                </button>
                            </h2>
                            <div id="collapseShipping" class="accordion-collapse collapse" aria-labelledby="headingShipping" data-bs-parent="#productDetailsAccordion">
                                <div class="accordion-body text-muted small">
                                    Dispatched within 24–48 hours in signature luxury boutique boxes. Complimentary express shipping across India. International door-to-door courier available to UK, USA, UAE, and Singapore.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===================================================
    3. COMPLEMENTARY HAUTE SILHOUETTES (RELATED PRODUCTS)
=================================================== --}}
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="related-silhouettes-section py-5 position-relative">
    <div class="container py-4">
        {{-- Section Heading --}}
        <div class="text-center mb-5" data-motion="fade-up">
            <span class="related-eyebrow text-gold fw-bold letter-spacing-2 small text-uppercase">
                ✦ CURATED ATELIER ENSEMBLES ✦
            </span>
            <h2 class="related-main-title mt-2 mb-2">You May Also Admire</h2>
            <p class="related-sub-title mx-auto text-muted">
                Heirloom handloom sarees and celebratory evening gowns crafted in harmonious South Indian artisanal drapes.
            </p>
        </div>

        {{-- Product Cards Grid --}}
        <div class="row g-3 g-md-4">
            @foreach($relatedProducts as $relIdx => $relProduct)
            @php
                $relDiscount = ($relProduct->sale_price !== null && $relProduct->sale_price < $relProduct->price);
                $relDiscountPct = $relDiscount ? round((($relProduct->price - $relProduct->sale_price) / $relProduct->price) * 100) : 0;
            @endphp
            <div class="col-6 col-lg-3" data-motion="fade-up" data-motion-delay="{{ $relIdx * 80 }}">
                <div class="luxury-related-card h-100" data-tilt="true">
                    {{-- Media Box --}}
                    <div class="related-media-box position-relative overflow-hidden">
                        @if($relDiscount && $relDiscountPct >= 1)
                        <div class="luxury-offer-badge">
                            <span>EXTRA {{ $relDiscountPct }}% OFF</span>
                        </div>
                        @endif

                        <a href="{{ route('product.details', $relProduct->slug) }}" class="d-block w-100 h-100">
                            <img src="{{ asset($relProduct->image) }}" 
                                 alt="{{ $relProduct->name }}" 
                                 class="related-img img-fluid" 
                                 loading="lazy">
                        </a>

                        {{-- Quick Add Slideup --}}
                        <div class="related-quick-add">
                            <form action="{{ route('cart.add', $relProduct->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn-related-add magnetic-btn">
                                    <i class="bi bi-bag-plus me-1 text-gold"></i>
                                    <span>Add to Bag</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="related-info p-3 d-flex flex-column flex-grow-1">
                        <span class="related-cat-label text-uppercase small text-gold fw-bold letter-spacing-1">
                            {{ $relProduct->category->name ?? 'Haute Silhouettes' }}
                        </span>
                        <h4 class="related-card-title mb-2 mt-1">
                            <a href="{{ route('product.details', $relProduct->slug) }}" class="related-name-link">
                                {{ $relProduct->name }}
                            </a>
                        </h4>
                        <div class="related-pricing d-flex align-items-baseline gap-2 mt-auto">
                            <span class="fw-bold text-purple-deep">
                                ₹{{ number_format($relProduct->sale_price ?? $relProduct->price, 2) }}
                            </span>
                            @if($relDiscount && $relDiscountPct >= 1)
                            <span class="text-muted text-decoration-line-through small">
                                ₹{{ number_format($relProduct->price, 2) }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- View All Link --}}
        <div class="text-center mt-5" data-motion="fade-up">
            <a href="{{ route('shop') }}" class="btn-royal-glass magnetic-btn">
                <span>Explore Full Haute Catalogue</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ===================================================
    4. INFINITE GOLDEN RUNWAY MARQUEE RIBBON
=================================================== --}}
<section class="luxury-marquee-section" aria-hidden="true">
    <div class="marquee-track">
        <div class="marquee-content">
            <span class="marquee-item"><i class="bi bi-gem text-gold"></i> 100% PURE MULBERRY KANCHIPURAM SILK</span>
            <span class="marquee-item"><i class="bi bi-stars text-gold"></i> AUTHENTIC GOLDEN ZARI WORK</span>
            <span class="marquee-item"><i class="bi bi-flower1 text-gold"></i> HANDLOOM CERTIFIED HERITAGE WEAVES</span>
            <span class="marquee-item"><i class="bi bi-shield-check text-gold"></i> DIRECT FROM MASTER WEAVERS</span>
            <span class="marquee-item"><i class="bi bi-airplane text-gold"></i> WORLDWIDE EXPRESS COURIER</span>
            <span class="marquee-item"><i class="bi bi-award text-gold"></i> BESPOKE BRIDAL TROUSSEAU CONSULTING</span>
        </div>
        <div class="marquee-content">
            <span class="marquee-item"><i class="bi bi-gem text-gold"></i> 100% PURE MULBERRY KANCHIPURAM SILK</span>
            <span class="marquee-item"><i class="bi bi-stars text-gold"></i> AUTHENTIC GOLDEN ZARI WORK</span>
            <span class="marquee-item"><i class="bi bi-flower1 text-gold"></i> HANDLOOM CERTIFIED HERITAGE WEAVES</span>
            <span class="marquee-item"><i class="bi bi-shield-check text-gold"></i> DIRECT FROM MASTER WEAVERS</span>
            <span class="marquee-item"><i class="bi bi-airplane text-gold"></i> WORLDWIDE EXPRESS COURIER</span>
            <span class="marquee-item"><i class="bi bi-award text-gold"></i> BESPOKE BRIDAL TROUSSEAU CONSULTING</span>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ===================================================
       1. GLOBAL LUXURY TOKENS & KEYFRAMES
    =================================================== */
    :root {
        --gold-primary: #d4af37;
        --gold-light: #f3e5ab;
        --gold-dark: #b8962e;
        --purple-deep: #2e102f;
        --purple-velvet: #1f0b20;
        --purple-accent: #8b4b7c;
        --cream-silk: #FAF8F1;
        --ease-luxury: cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Motion Entrance Classes */
    [data-motion] {
        opacity: 0;
        transition-property: opacity, transform;
        transition-duration: 0.85s;
        transition-timing-function: var(--ease-luxury);
        will-change: opacity, transform;
    }

    [data-motion="fade-up"] { transform: translateY(30px); }
    [data-motion="fade-down"] { transform: translateY(-30px); }
    [data-motion="fade-left"] { transform: translateX(35px); }
    [data-motion="fade-right"] { transform: translateX(-35px); }
    [data-motion="zoom-in"] { transform: scale(0.92); }

    [data-motion].motion-active {
        opacity: 1 !important;
        transform: translate(0, 0) scale(1) !important;
    }

    .text-gold { color: var(--gold-primary) !important; }
    .text-purple-deep { color: var(--purple-deep) !important; }
    .bg-cream-silk { background-color: var(--cream-silk) !important; }
    .border-gold-light { border-color: rgba(212, 175, 55, 0.25) !important; }

    /* ===================================================
       2. HAUTE HERO BREADCRUMB
    =================================================== */
    .boutique-details-hero {
        background: radial-gradient(circle at 70% 30%, #451b47 0%, #2e102f 50%, #1a081b 100%);
        color: #ffffff;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .details-ambient-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        z-index: 1;
    }

    .glow-gold {
        top: -20%;
        right: 15%;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.22) 0%, transparent 70%);
    }

    .glow-berry {
        bottom: -20%;
        left: -10%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(139, 75, 124, 0.25) 0%, transparent 70%);
    }

    .details-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(212, 175, 55, 0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        opacity: 0.5;
    }

    .details-luxury-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.82rem;
        transition: color 0.3s ease;
    }

    .details-luxury-breadcrumb .breadcrumb-item a:hover {
        color: var(--gold-primary);
    }

    .details-luxury-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(212, 175, 55, 0.6);
        content: "✦";
        font-size: 0.65rem;
        padding: 0 10px;
    }

    /* ===================================================
       3. PRODUCT SHOWCASE GALLERY
    =================================================== */
    .product-details-luxury-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
    }

    .product-gallery-sticky {
        position: sticky;
        top: 90px;
    }

    .product-main-showcase {
        background: #FAF8F1;
        border-radius: 24px;
        border: 1.5px solid rgba(212, 175, 55, 0.35);
        box-shadow: 0 15px 40px rgba(46, 16, 47, 0.08);
        transform-style: preserve-3d;
        transition: transform 0.45s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.45s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .product-main-showcase:hover {
        box-shadow: 0 25px 60px rgba(46, 16, 47, 0.18), 0 0 30px rgba(212, 175, 55, 0.25);
    }

    .main-image-wrap {
        width: 100%;
        height: 560px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 15px;
    }

    .product-main-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), opacity 0.3s ease;
    }

    .product-main-showcase:hover .product-main-image {
        transform: scale(1.05);
    }

    .showcase-gold-frame {
        position: absolute;
        inset: 12px;
        border: 1px solid rgba(212, 175, 55, 0.35);
        border-radius: 18px;
        pointer-events: none;
        transition: all 0.4s ease;
    }

    .product-main-showcase:hover .showcase-gold-frame {
        inset: 8px;
        border-color: rgba(212, 175, 55, 0.7);
    }

    .luxury-detail-offer-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 6px 14px;
        border-radius: 30px;
        z-index: 3;
        box-shadow: 0 4px 15px rgba(194, 24, 91, 0.4);
    }

    .luxury-detail-featured-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #2e102f;
        color: var(--gold-primary);
        border: 1px solid rgba(212, 175, 55, 0.4);
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 6px 14px;
        border-radius: 30px;
        z-index: 3;
    }

    .authenticity-watermark {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: rgba(46, 16, 47, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 30px;
        padding: 5px 14px;
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 600;
        z-index: 3;
    }

    /* Thumbnails */
    .gallery-thumbnails-strip {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding: 4px 2px;
        scrollbar-width: thin;
        scrollbar-color: rgba(212, 175, 55, 0.4) transparent;
    }

    .thumb-card {
        width: 82px;
        height: 82px;
        border-radius: 14px;
        background: #ffffff;
        border: 2px solid rgba(46, 16, 47, 0.1);
        padding: 4px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .variant-thumbnail-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .thumb-card:hover {
        border-color: var(--gold-primary);
        transform: translateY(-2px);
    }

    .thumb-card.active {
        border-color: var(--gold-primary);
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
    }

    .thumb-gold-indicator {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--gold-primary);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .thumb-card.active .thumb-gold-indicator {
        opacity: 1;
    }

    /* ===================================================
       4. PRODUCT SPECIFICATIONS & EDITORIAL PANEL
    =================================================== */
    .detail-royal-pill {
        display: inline-flex;
        align-items: center;
        background: rgba(46, 16, 47, 0.06);
        border: 1px solid rgba(212, 175, 55, 0.4);
        color: var(--purple-deep);
        padding: 4px 12px;
        border-radius: 25px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1.2px;
    }

    .product-haute-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.8rem, 2.8vw, 2.5rem);
        font-weight: 700;
        color: var(--purple-deep);
        line-height: 1.2;
    }

    .current-price-headline {
        font-size: clamp(2rem, 3vw, 2.4rem);
        font-weight: 800;
        color: var(--purple-deep);
        letter-spacing: -0.5px;
    }

    .original-price-strike {
        font-size: 1.2rem;
        color: #999;
        text-decoration: line-through;
        font-weight: 500;
    }

    .savings-ribbon-badge {
        font-size: 0.78rem;
        font-weight: 700;
        color: #c2185b;
        background: #fce4ec;
        padding: 4px 10px;
        border-radius: 14px;
    }

    .product-editorial-description {
        font-size: 0.96rem;
        color: #555555;
        line-height: 1.8;
    }

    /* Variant Buttons */
    .variant-group-label {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .selected-val-badge {
        font-weight: 600;
        color: var(--gold-dark);
        margin-left: 6px;
    }

    .variant-color-btn,
    .variant-size-btn {
        background: #ffffff;
        border: 1.5px solid rgba(46, 16, 47, 0.15);
        color: #444;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.84rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s ease;
    }

    .btn-color-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--gold-primary);
        display: inline-block;
    }

    .variant-color-btn:hover,
    .variant-size-btn:hover {
        border-color: var(--gold-primary);
        color: var(--purple-deep);
        transform: translateY(-2px);
    }

    .variant-color-btn.active,
    .variant-size-btn.active {
        background: var(--purple-deep);
        color: var(--gold-light);
        border-color: var(--gold-primary);
        box-shadow: 0 4px 15px rgba(46, 16, 47, 0.25);
    }

    .variant-color-btn:disabled,
    .variant-size-btn:disabled {
        opacity: 0.35;
        cursor: not-allowed;
        text-decoration: line-through;
        transform: none !important;
    }

    /* Stock Status Pills */
    .stock-pill {
        display: inline-flex;
        align-items: center;
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .stock-pending {
        background: #fff8e1;
        color: #b78103;
        border: 1px solid #ffe082;
    }

    .stock-available {
        background: #e8f5e9;
        color: #1b5e20;
        border: 1px solid #a5d6a7;
    }

    .stock-unavailable {
        background: #ffebee;
        color: #b71c1c;
        border: 1px solid #ef9a9a;
    }

    /* Direct attributes */
    .attribute-tile {
        background: #FAF8F1;
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 12px;
        padding: 8px 16px;
    }

    /* Quantity Stepper */
    .quantity-stepper-box {
        background: #ffffff;
        border: 1.5px solid rgba(46, 16, 47, 0.15);
        border-radius: 50px;
        padding: 4px 6px;
    }

    .qty-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: transparent;
        border: none;
        color: var(--purple-deep);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .qty-btn:hover {
        background: rgba(46, 16, 47, 0.08);
    }

    .qty-input {
        width: 50px;
        border: none !important;
        background: transparent !important;
        font-weight: 700;
        color: var(--purple-deep);
        font-size: 1rem;
        box-shadow: none !important;
        padding: 0;
    }

    /* Buttons */
    .btn-royal-gold-cart {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 13px 26px;
        border-radius: 50px;
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        font-weight: 800;
        font-size: 0.88rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: 1px solid #F3E5AB;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.35s var(--ease-luxury);
    }

    .btn-royal-gold-cart:hover:not(:disabled) {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 14px 30px rgba(212, 175, 55, 0.6);
        color: #1a081b;
    }

    .btn-royal-gold-cart:disabled {
        background: #ddd;
        border-color: #ddd;
        color: #888;
        box-shadow: none;
        cursor: not-allowed;
    }

    .btn-luxury-wishlist {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #ffffff;
        border: 1.5px solid rgba(46, 16, 47, 0.15);
        color: var(--purple-deep);
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .btn-luxury-wishlist:hover {
        background: var(--purple-deep);
        color: #ff3366;
        border-color: var(--purple-deep);
        transform: scale(1.1);
    }

    .btn-luxury-wishlist.wishlist-saved {
        background: #ffffff;
        color: #ff3366;
        border-color: #ff3366;
    }

    /* WhatsApp Touchpoint */
    .concierge-touchpoint-box {
        background: #f0fdf4;
        border: 1.5px solid #86efac;
    }

    .concierge-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #25D366;
        color: #ffffff;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .btn-wa-consult {
        background: #25D366;
        color: #ffffff;
        border-radius: 30px;
        padding: 8px 16px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        transition: all 0.25s ease;
    }

    .btn-wa-consult:hover {
        background: #1ebc59;
        color: #ffffff;
        transform: translateY(-2px);
    }

    /* Luxury Accordion */
    .luxury-accordion .accordion-item {
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(212, 175, 55, 0.25);
    }

    .luxury-accordion .accordion-button {
        background: transparent;
        font-weight: 700;
        font-size: 0.92rem;
        color: var(--purple-deep);
        padding: 16px 0;
        box-shadow: none;
    }

    .luxury-accordion .accordion-button:not(.collapsed) {
        color: var(--purple-deep);
        border-bottom: none;
    }

    .luxury-accordion .accordion-body {
        padding: 0 0 16px;
        line-height: 1.7;
    }

    /* Shimmer Effect */
    .btn-shimmer-sweep {
        position: absolute;
        top: 0;
        left: -100%;
        width: 60%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        transform: skewX(-25deg);
        animation: btnSweep 3.5s infinite;
    }

    @keyframes btnSweep {
        0% { left: -100%; }
        25% { left: 180%; }
        100% { left: 180%; }
    }

    /* ===================================================
       5. RELATED SILHOUETTES
    =================================================== */
    .related-silhouettes-section {
        background: #ffffff;
        border-top: 1px solid rgba(212, 175, 55, 0.25);
    }

    .related-main-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .related-sub-title {
        max-width: 580px;
        font-size: 0.95rem;
    }

    .luxury-related-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid rgba(212, 175, 55, 0.22);
        box-shadow: 0 8px 24px rgba(46, 16, 47, 0.05);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transform-style: preserve-3d;
        transition: transform 0.4s var(--ease-luxury), box-shadow 0.4s var(--ease-luxury), border-color 0.4s ease;
    }

    .luxury-related-card:hover {
        box-shadow: 0 18px 40px rgba(46, 16, 47, 0.15), 0 0 20px rgba(212, 175, 55, 0.2);
        border-color: rgba(212, 175, 55, 0.7);
    }

    .related-media-box {
        position: relative;
        width: 100%;
        aspect-ratio: 3 / 3.8;
        background: #FAF8F1;
    }

    .related-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s var(--ease-luxury);
    }

    .luxury-related-card:hover .related-img {
        transform: scale(1.08);
    }

    .related-quick-add {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px;
        background: linear-gradient(180deg, transparent 0%, rgba(31, 11, 32, 0.85) 100%);
        transform: translateY(100%);
        transition: transform 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
        z-index: 2;
    }

    .luxury-related-card:hover .related-quick-add {
        transform: translateY(0);
    }

    .btn-related-add {
        width: 100%;
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        border: none;
        border-radius: 25px;
        padding: 7px;
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
    }

    .related-name-link {
        color: var(--purple-deep);
        text-decoration: none;
        font-size: 0.92rem;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .related-name-link:hover {
        color: var(--purple-accent);
    }

    .btn-royal-glass {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 28px;
        border-radius: 50px;
        background: rgba(46, 16, 47, 0.05);
        color: var(--purple-deep);
        font-weight: 600;
        font-size: 0.86rem;
        letter-spacing: 0.5px;
        border: 1.5px solid rgba(212, 175, 55, 0.45);
        transition: all 0.35s var(--ease-luxury);
        text-decoration: none;
    }

    .btn-royal-glass:hover {
        background: var(--purple-deep);
        color: #ffffff;
        border-color: var(--purple-deep);
        transform: translateY(-2px);
    }

    /* ===================================================
       6. INFINITE MARQUEE
    =================================================== */
    .luxury-marquee-section {
        background: #1b071c;
        border-top: 1px solid rgba(212, 175, 55, 0.3);
        border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        padding: 14px 0;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
    }

    .marquee-track {
        display: flex;
        width: max-content;
        animation: marqueeScroll 35s linear infinite;
    }

    .luxury-marquee-section:hover .marquee-track {
        animation-play-state: paused;
    }

    @keyframes marqueeScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .marquee-content {
        display: flex;
        align-items: center;
        gap: 30px;
        padding-right: 30px;
    }

    .marquee-item {
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 991px) {
        .product-gallery-sticky {
            position: static;
        }

        .main-image-wrap {
            height: 420px;
        }
    }

    @media (max-width: 575px) {
        .main-image-wrap {
            height: 320px;
        }

        .action-bar-row {
            flex-direction: column;
        }

        .quantity-stepper-box,
        .btn-royal-gold-cart {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // ===================================================
    // 1. INTERSECTION OBSERVER SCROLL REVEAL
    // ===================================================
    const motionElements = document.querySelectorAll('[data-motion]');
    if ('IntersectionObserver' in window) {
        const motionObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const delay = el.getAttribute('data-motion-delay') || 0;
                    setTimeout(() => {
                        el.classList.add('motion-active');
                    }, parseInt(delay, 10));
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -30px 0px' });
        motionElements.forEach(el => motionObserver.observe(el));
    } else {
        motionElements.forEach(el => el.classList.add('motion-active'));
    }

    // ===================================================
    // 2. 3D PERSPECTIVE TILT
    // ===================================================
    const tiltCards = document.querySelectorAll('[data-tilt="true"]');
    tiltCards.forEach(card => {
        let isHovered = false;
        card.addEventListener('mouseenter', () => {
            isHovered = true;
            card.style.transition = 'transform 0.1s ease-out';
        });
        card.addEventListener('mousemove', (e) => {
            if (!isHovered) return;
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const deltaX = (x - rect.width / 2) / (rect.width / 2);
            const deltaY = (y - rect.height / 2) / (rect.height / 2);
            const maxTilt = 6;
            card.style.transform = `perspective(800px) rotateX(${(-deltaY * maxTilt).toFixed(2)}deg) rotateY(${(deltaX * maxTilt).toFixed(2)}deg) translateY(-4px)`;
        });
        card.addEventListener('mouseleave', () => {
            isHovered = false;
            card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
            card.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });
    });

    // ===================================================
    // 3. MAGNETIC BUTTONS
    // ===================================================
    const magneticButtons = document.querySelectorAll('.magnetic-btn');
    magneticButtons.forEach(btn => {
        btn.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            this.style.transform = `translate(${x * 0.22}px, ${y * 0.22}px)`;
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translate(0px, 0px)';
            this.style.transition = 'transform 0.4s var(--ease-luxury)';
        });
        btn.addEventListener('mouseenter', function() {
            this.style.transition = 'transform 0.1s ease-out';
        });
    });

    // ===================================================
    // 4. QUANTITY STEPPER BUTTONS
    // ===================================================
    const qtyInput = document.getElementById('quantity');
    const qtyMinus = document.getElementById('qtyMinusBtn');
    const qtyPlus = document.getElementById('qtyPlusBtn');

    if (qtyMinus && qtyPlus && qtyInput) {
        qtyMinus.addEventListener('click', () => {
            let current = parseInt(qtyInput.value) || 1;
            if (current > 1) {
                qtyInput.value = current - 1;
            }
        });
        qtyPlus.addEventListener('click', () => {
            let current = parseInt(qtyInput.value) || 1;
            const max = parseInt(qtyInput.max) || 99;
            if (current < max) {
                qtyInput.value = current + 1;
            }
        });
    }

    // ===================================================
    // 5. VARIANT SELECTION LOGIC
    // ===================================================
    @if($product->variants->count() > 0)
    @php
        $mappedVariants = $product->variants->map(function($variant) use($product) {
            return [
                'id' => $variant->id,
                'size' => $variant->size,
                'color' => $variant->color,
                'price' => $variant->price ?? $product->sale_price ?? $product->price,
                'stock' => (int) $variant->stock,
                'images' => $variant->images->pluck('image_path')->map(fn($path) => asset($path))->toArray(),
                'raw_images' => $variant->images->pluck('image_path')->toArray(),
            ];
        })->values();
    @endphp
    const variants = @json($mappedVariants);

    const colorButtons = document.querySelectorAll('.variant-color-btn');
    const sizeButtons = document.querySelectorAll('.variant-size-btn');
    const selectedColorText = document.getElementById('selectedColor');
    const selectedSizeText = document.getElementById('selectedSize');
    const selectedVariantInput = document.getElementById('selectedVariantId');
    const selectedImageInput = document.getElementById('selectedImageInput');
    const productPrice = document.getElementById('productPrice');
    const stockStatus = document.getElementById('stockStatus');
    const addToCartBtn = document.getElementById('addToCartBtn');

    const hasColors = colorButtons.length > 0;
    const hasSizes = sizeButtons.length > 0;

    let selectedColor = null;
    let selectedSize = null;

    function findSelectedVariant() {
        return variants.find(v => (!hasColors || v.color === selectedColor) && (!hasSizes || v.size === selectedSize));
    }

    function updateVariant() {
        const variant = findSelectedVariant();
        selectedVariantInput.value = '';

        // Dynamic gallery updates based on selection
        let matchingVariants = variants;
        if (selectedColor) matchingVariants = matchingVariants.filter(v => v.color === selectedColor);
        if (selectedSize) matchingVariants = matchingVariants.filter(v => v.size === selectedSize);

        let imagesToShow = [];
        let rawImagesToShow = [];
        matchingVariants.forEach(v => {
            if (v.images && v.images.length > 0) {
                imagesToShow.push(...v.images);
                if (v.raw_images) rawImagesToShow.push(...v.raw_images);
            }
        });
        imagesToShow = [...new Set(imagesToShow)];
        rawImagesToShow = [...new Set(rawImagesToShow)];

        if (imagesToShow.length === 0) {
            imagesToShow = ['{{ asset($product->image) }}'];
            rawImagesToShow = ['{{ $product->image }}'];
        }

        const thumbnailsContainer = document.getElementById('variantThumbnailsContainer');
        const mainImage = document.getElementById('mainProductImage');

        if (thumbnailsContainer && imagesToShow.length > 1) {
            thumbnailsContainer.classList.remove('d-none');
            thumbnailsContainer.innerHTML = '';
            mainImage.src = imagesToShow[0];
            if (selectedImageInput) {
                selectedImageInput.value = rawImagesToShow[0] || imagesToShow[0];
            }

            imagesToShow.forEach((imgSrc, idx) => {
                const rawPath = rawImagesToShow[idx] || imgSrc;
                const card = document.createElement('div');
                card.className = 'thumb-card' + (idx === 0 ? ' active' : '');
                card.onclick = function() { switchShowcaseImage(imgSrc, this, rawPath); };

                const img = document.createElement('img');
                img.src = imgSrc;
                img.className = 'variant-thumbnail-img';
                card.appendChild(img);

                const ind = document.createElement('div');
                ind.className = 'thumb-gold-indicator';
                card.appendChild(ind);

                thumbnailsContainer.appendChild(card);
            });
        } else if (imagesToShow.length === 1) {
            mainImage.src = imagesToShow[0];
            if (selectedImageInput) {
                selectedImageInput.value = rawImagesToShow[0] || imagesToShow[0];
            }
            if (thumbnailsContainer) thumbnailsContainer.classList.add('d-none');
        }

        if (!variant) {
            stockStatus.innerHTML = '<i class="bi bi-info-circle me-1"></i> Please choose available shade & size';
            stockStatus.className = 'stock-pill stock-pending';
            addToCartBtn.disabled = true;
            updateAvailableOptions();
            return;
        }

        selectedVariantInput.value = variant.id;
        productPrice.textContent = '₹' + Number(variant.price).toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        if (qtyInput) {
            qtyInput.value = 1;
            qtyInput.max = variant.stock;
        }

        if (variant.stock > 0) {
            stockStatus.innerHTML = `<i class="bi bi-check-circle-fill me-1"></i> In Stock (${variant.stock} available)`;
            stockStatus.className = 'stock-pill stock-available';
            addToCartBtn.disabled = false;
        } else {
            stockStatus.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Out of Stock';
            stockStatus.className = 'stock-pill stock-unavailable';
            addToCartBtn.disabled = true;
        }

        updateAvailableOptions();
    }

    function updateAvailableOptions() {
        colorButtons.forEach(button => {
            const color = button.dataset.color;
            const available = variants.some(v => v.color === color && (!selectedSize || v.size === selectedSize) && v.stock > 0);
            button.disabled = !available;
        });

        sizeButtons.forEach(button => {
            const size = button.dataset.size;
            const available = variants.some(v => v.size === size && (!selectedColor || v.color === selectedColor) && v.stock > 0);
            button.disabled = !available;
        });
    }

    colorButtons.forEach(button => {
        button.addEventListener('click', function() {
            selectedColor = this.dataset.color;
            if (selectedColorText) selectedColorText.textContent = selectedColor;
            colorButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            if (selectedSize && !findSelectedVariant()) {
                selectedSize = null;
                if (selectedSizeText) selectedSizeText.textContent = 'Select Size';
                sizeButtons.forEach(btn => btn.classList.remove('active'));
            }
            updateVariant();
        });
    });

    sizeButtons.forEach(button => {
        button.addEventListener('click', function() {
            selectedSize = this.dataset.size;
            if (selectedSizeText) selectedSizeText.textContent = selectedSize;
            sizeButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            if (selectedColor && !findSelectedVariant()) {
                selectedColor = null;
                if (selectedColorText) selectedColorText.textContent = 'Select Shade';
                colorButtons.forEach(btn => btn.classList.remove('active'));
            }
            updateVariant();
        });
    });

    updateAvailableOptions();
    @endif
});

// Switch Main Showcase Image
function switchShowcaseImage(src, cardEl, rawPath) {
    const mainImg = document.getElementById('mainProductImage');
    if (mainImg) {
        mainImg.style.opacity = '0.3';
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 150);
    }
    document.querySelectorAll('.thumb-card').forEach(c => c.classList.remove('active'));
    if (cardEl) cardEl.classList.add('active');

    const selectedImgInput = document.getElementById('selectedImageInput');
    if (selectedImgInput) {
        selectedImgInput.value = rawPath || src;
    }
}

// Handle Wishlist Heart Click
function handleProductDetailWishlist(btn, url) {
    btn.classList.toggle('wishlist-saved');
    if (btn.classList.contains('wishlist-saved')) {
        btn.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>';
    } else {
        btn.innerHTML = '<i class="bi bi-heart"></i>';
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).catch(err => console.error(err));
}
</script>
@endpush
