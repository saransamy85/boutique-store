@extends('frontend.layouts.app')

@php
$brand = 'Kathirazhagi Boutique';
@endphp

@section('title', 'Saved Silhouettes | ' . $brand)
@section('meta_description', 'Your curated wishlist of handcrafted South Indian handloom silk sarees, chanderi suits, and designer gowns at ' . $brand . '.')

@section('content')

{{-- ===================================================
    HAUTE WISHLIST HERO BANNER
=================================================== --}}
<section class="boutique-wishlist-hero position-relative overflow-hidden">
    {{-- Ambient Radiant Glow Orbs --}}
    <div class="wishlist-ambient-glow glow-gold"></div>
    <div class="wishlist-ambient-glow glow-berry"></div>
    <div class="wishlist-grid-pattern"></div>

    <div class="container position-relative z-2 py-4">
        {{-- Breadcrumb Trail --}}
        <nav aria-label="breadcrumb" data-motion="fade-down" data-motion-delay="100">
            <ol class="breadcrumb wishlist-luxury-breadcrumb mb-3">
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
                <li class="breadcrumb-item active text-gold fw-semibold" aria-current="page">
                    Saved Silhouettes
                </li>
            </ol>
        </nav>

        <div class="row align-items-center g-4">
            <div class="col-lg-8" data-motion="fade-right" data-motion-duration="900">
                <div class="wishlist-royal-pill mb-2">
                    <span class="pill-sparkle"><i class="bi bi-heart-fill text-danger"></i></span>
                    <span class="pill-text">PATRON CURATION ARCHIVE</span>
                    <span class="pill-divider">•</span>
                    <span class="pill-sub">{{ $products->count() }} SAVED PIECES</span>
                </div>

                <h1 class="wishlist-hero-title mb-2">
                    Your Curated <span class="gold-gradient-text">Wishlist.</span>
                </h1>
                <p class="wishlist-hero-lead mb-0 text-white-80">
                    Handpicked heirlooms reserved for your private celebrations. Move your desired pieces to your bag anytime.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    WISHLIST ITEMS GRID
=================================================== --}}
<section class="wishlist-main-section py-5 position-relative">
    <div class="container">

        {{-- Alerts --}}
        @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-2" data-motion="fade-down">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-2" data-motion="fade-down">
            <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
            <div>{{ session('error') }}</div>
        </div>
        @endif

        @if($products->count() > 0)
        <div class="row g-3 g-md-4">
            @foreach($products as $index => $product)
            @php
                $hasDiscount = ($product->sale_price !== null && $product->sale_price < $product->price);
                $discountPercent = $hasDiscount ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
            @endphp
            <div class="col-6 col-md-4 col-lg-3" data-motion="fade-up" data-motion-delay="{{ ($index % 4) * 70 }}">
                <div class="luxury-product-card h-100" data-tilt="true">

                    {{-- Image Media Box --}}
                    <div class="luxury-media-box position-relative overflow-hidden">
                        @if($hasDiscount && $discountPercent >= 1)
                        <div class="luxury-offer-badge">
                            <span>EXTRA {{ $discountPercent }}% OFF</span>
                        </div>
                        @endif

                        <a href="{{ route('product.details', $product->slug) }}" class="d-block w-100 h-100">
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="luxury-product-img" loading="lazy">
                            @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-cream-silk">
                                <i class="bi bi-image fs-1 text-gold"></i>
                            </div>
                            @endif
                        </a>

                        {{-- Remove from Wishlist Floating Button --}}
                        <div class="position-absolute top-0 end-0 p-2 z-3">
                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-wishlist-remove" title="Remove Silhouette" aria-label="Remove Silhouette">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Product Details Info --}}
                    <div class="luxury-product-info">
                        <span class="product-category-eyebrow">
                            {{ $product->category->name ?? 'Haute Silhouettes' }}
                        </span>

                        <h3 class="product-card-title mb-2 mt-1">
                            <a href="{{ route('product.details', $product->slug) }}" class="product-name-link">
                                {{ $product->name }}
                            </a>
                        </h3>

                        {{-- Price --}}
                        <div class="product-pricing-strip d-flex align-items-baseline gap-2 mb-3 mt-auto">
                            <span class="current-price-val">
                                ₹{{ number_format((float) ($product->sale_price ?? $product->price), 2) }}
                            </span>
                            @if($hasDiscount && $discountPercent >= 1)
                            <span class="original-price-val">
                                ₹{{ number_format((float) $product->price, 2) }}
                            </span>
                            @endif
                        </div>

                        {{-- Move to Bag Action --}}
                        @if($product->stock > 0)
                        <form action="{{ route('wishlist.moveToCart', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-move-to-bag magnetic-btn w-100">
                                <i class="bi bi-bag-plus me-1 text-gold"></i>
                                <span>Move to Bag</span>
                            </button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-sm w-100 rounded-pill" disabled>
                            Out of Stock
                        </button>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        @else
        {{-- Empty Wishlist Box --}}
        <div class="wishlist-empty-box text-center p-5 rounded-4 bg-white border border-gold-light shadow-sm" data-motion="zoom-in">
            <div class="empty-crest-wrap mb-4">
                <div class="empty-crest-icon">
                    <i class="bi bi-heart"></i>
                </div>
            </div>
            <span class="text-gold fw-bold letter-spacing-2 small text-uppercase">
                ✦ PATRON ARCHIVE ✦
            </span>
            <h3 class="mt-2 mb-2 fw-bold text-purple-deep">Your Wishlist Is Currently Empty</h3>
            <p class="text-muted mx-auto mb-4" style="max-width: 520px;">
                You haven't reserved any handloom silhouettes yet. Explore our latest festival collections and click the heart icon on any piece to save it here.
            </p>
            <a href="{{ route('shop') }}" class="btn-royal-gold magnetic-btn">
                <span>Explore Haute Catalogue</span>
                <i class="bi bi-arrow-right ms-2"></i>
                <div class="btn-shimmer-sweep"></div>
            </a>
        </div>
        @endif

    </div>
</section>

@endsection

@push('styles')
<style>
    :root {
        --gold-primary: #d4af37;
        --gold-light: #f3e5ab;
        --gold-dark: #b8962e;
        --purple-deep: #2e102f;
        --purple-velvet: #1f0b20;
        --cream-silk: #FAF8F1;
        --ease-luxury: cubic-bezier(0.16, 1, 0.3, 1);
    }

    .boutique-wishlist-hero {
        background: radial-gradient(circle at 75% 25%, #451b47 0%, #2e102f 50%, #1a081b 100%);
        color: #ffffff;
        padding-top: 20px;
        padding-bottom: 25px;
    }

    .wishlist-ambient-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(110px);
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

    .wishlist-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(212, 175, 55, 0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        opacity: 0.5;
    }

    .wishlist-luxury-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.82rem;
        transition: color 0.3s ease;
    }

    .wishlist-luxury-breadcrumb .breadcrumb-item a:hover {
        color: var(--gold-primary);
    }

    .wishlist-luxury-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(212, 175, 55, 0.6);
        content: "✦";
        font-size: 0.65rem;
        padding: 0 10px;
    }

    .wishlist-royal-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 5px 16px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        color: var(--gold-light);
    }

    .wishlist-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 3.2vw, 3rem);
        font-weight: 700;
        color: #ffffff;
    }

    .wishlist-main-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
    }

    .luxury-product-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(212, 175, 55, 0.22);
        box-shadow: 0 10px 25px rgba(46, 16, 47, 0.06);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transform-style: preserve-3d;
        transition: transform 0.4s var(--ease-luxury), box-shadow 0.4s var(--ease-luxury), border-color 0.4s ease;
    }

    .luxury-product-card:hover {
        box-shadow: 0 20px 45px rgba(46, 16, 47, 0.16);
        border-color: rgba(212, 175, 55, 0.7);
    }

    .luxury-media-box {
        position: relative;
        width: 100%;
        aspect-ratio: 3 / 4;
        background: #FAF8F1;
    }

    .luxury-product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s var(--ease-luxury);
    }

    .luxury-product-card:hover .luxury-product-img {
        transform: scale(1.08);
    }

    .btn-wishlist-remove {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(46, 16, 47, 0.15);
        color: #c2185b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-wishlist-remove:hover {
        background: #c2185b;
        color: #ffffff;
        transform: scale(1.1);
    }

    .luxury-product-info {
        padding: 16px 14px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-category-eyebrow {
        font-size: 0.68rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--gold-dark);
    }

    .product-card-title {
        font-size: 0.94rem;
        font-weight: 600;
        line-height: 1.35;
    }

    .product-name-link {
        color: var(--purple-deep);
        text-decoration: none;
    }

    .product-name-link:hover {
        color: var(--purple-accent);
    }

    .current-price-val {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .original-price-val {
        font-size: 0.85rem;
        color: #999;
        text-decoration: line-through;
    }

    .btn-move-to-bag {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 9px 16px;
        border-radius: 50px;
        background: var(--purple-deep);
        color: var(--gold-light);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border: 1px solid rgba(212, 175, 55, 0.4);
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .btn-move-to-bag:hover {
        background: var(--gold-primary);
        color: #2e102f;
        transform: translateY(-2px);
    }

    .empty-crest-icon {
        width: 74px;
        height: 74px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, rgba(46, 16, 47, 0.05) 100%);
        border: 1.5px solid var(--gold-primary);
        color: var(--gold-primary);
        font-size: 2rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-royal-gold {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 28px;
        border-radius: 50px;
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        font-weight: 700;
        font-size: 0.84rem;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        border: 1px solid #F3E5AB;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.35);
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .btn-royal-gold:hover {
        color: #1a081b;
        transform: translateY(-2px);
    }
</style>
@endpush
