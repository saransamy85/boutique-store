@extends('frontend.layouts.app')

@php
$brand = 'Kathirazhagi Boutique';
@endphp

@section('title', 'Shopping Bag | ' . $brand)
@section('meta_description', 'Review your selected South Indian handloom silk sarees, chanderi suits, and designer silhouettes in your shopping bag at ' . $brand . '.')

@section('content')

{{-- ===================================================
    HAUTE BAG HERO BANNER & STEPPER
=================================================== --}}
<section class="boutique-cart-hero position-relative overflow-hidden">
    {{-- Ambient Radiant Glow Orbs --}}
    <div class="cart-ambient-glow glow-gold"></div>
    <div class="cart-ambient-glow glow-berry"></div>
    <div class="cart-grid-pattern"></div>

    <div class="container position-relative z-2 py-4">
        {{-- Breadcrumb Trail --}}
        <nav aria-label="breadcrumb" data-motion="fade-down" data-motion-delay="100">
            <ol class="breadcrumb cart-luxury-breadcrumb mb-3">
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
                    Shopping Bag
                </li>
            </ol>
        </nav>

        <div class="row align-items-center g-4">
            <div class="col-lg-8" data-motion="fade-right" data-motion-duration="900">
                <div class="cart-royal-pill mb-2">
                    <span class="pill-sparkle"><i class="bi bi-bag-check-fill"></i></span>
                    <span class="pill-text">ATELIER RESERVATIONS</span>
                    <span class="pill-divider">•</span>
                    <span class="pill-sub">{{ count($cartItems) }} {{ count($cartItems) === 1 ? 'SILHOUETTE' : 'SILHOUETTES' }} SELECTED</span>
                </div>

                <h1 class="cart-hero-title mb-2">
                    Your Shopping <span class="gold-gradient-text">Bag.</span>
                </h1>
                <p class="cart-hero-lead mb-0 text-white-80">
                    Review your selected pieces and reserve your handloom couture before proceeding to secure checkout.
                </p>
            </div>

            {{-- 3-Step Process Indicator on Hero Right --}}
            <div class="col-lg-4" data-motion="fade-left" data-motion-delay="150">
                <div class="cart-steps-badge-wrap p-3 rounded-4 bg-glass border border-gold-subtle">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="step-label text-gold small fw-bold letter-spacing-1">ORDER PROGRESS</span>
                        <span class="step-num text-white-50 small">Step 1 of 3</span>
                    </div>
                    <div class="stepper-progress-bar mb-2">
                        <div class="stepper-progress-fill" style="width: 33%;"></div>
                    </div>
                    <div class="d-flex justify-content-between text-white-75 small">
                        <span class="text-white fw-bold"><i class="bi bi-dot text-gold"></i> Bag</span>
                        <span class="text-white-50">Shipping</span>
                        <span class="text-white-50">Confirmation</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    MAIN CART CONTENT
=================================================== --}}
<section class="cart-main-section py-5 position-relative">
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

        @if($errors->any())
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4" data-motion="fade-down">
            @foreach($errors->all() as $error)
            <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
            @endforeach
        </div>
        @endif

        @if(count($cartItems) > 0)
        <div class="row g-4 g-lg-5 align-items-start">

            {{-- Cart Items List (Left Column) --}}
            <div class="col-lg-8" data-motion="fade-right">
                <div class="cart-items-wrapper">
                    @foreach($cartItems as $item)
                    <div class="cart-item-card p-4 rounded-4 bg-white border border-gold-light shadow-sm mb-3" data-tilt="true">
                        <div class="row align-items-center g-3">

                            {{-- Product Thumbnail --}}
                            <div class="col-3 col-sm-2">
                                <a href="{{ route('product.details', $item['product']->slug) }}" class="d-block rounded-3 overflow-hidden border border-gold-subtle">
                                    @php
                                        $displayImg = $item['selected_image'] ?? $item['product']->image;
                                    @endphp
                                    @if($displayImg)
                                    <img src="{{ asset($displayImg) }}" 
                                         alt="{{ $item['product']->name }}" 
                                         class="cart-item-img img-fluid">
                                    @else
                                    <div class="d-flex align-items-center justify-content-center bg-cream-silk" style="height: 90px;">
                                        <i class="bi bi-image text-gold fs-4"></i>
                                    </div>
                                    @endif
                                </a>
                            </div>

                            {{-- Product Details --}}
                            <div class="col-9 col-sm-5">
                                <span class="small text-gold-dark fw-bold text-uppercase letter-spacing-1 d-block mb-1">
                                    {{ $item['product']->category->name ?? 'Haute Silhouette' }}
                                </span>
                                <h5 class="cart-item-name mb-1">
                                    <a href="{{ route('product.details', $item['product']->slug) }}" class="text-purple-deep">
                                        {{ $item['product']->name }}
                                    </a>
                                </h5>
                                @if(isset($item['variant']) && $item['variant'])
                                <div class="d-flex flex-wrap gap-2 my-1">
                                    @if($item['variant']->color)
                                    <span class="badge bg-cream-silk text-purple-deep border border-gold-light small">
                                        <i class="bi bi-palette text-gold me-1"></i> {{ $item['variant']->color }}
                                    </span>
                                    @endif
                                    @if($item['variant']->size)
                                    <span class="badge bg-cream-silk text-purple-deep border border-gold-light small">
                                        <i class="bi bi-rulers text-gold me-1"></i> {{ $item['variant']->size }}
                                    </span>
                                    @endif
                                </div>
                                @endif
                                @if($item['product']->sku)
                                <span class="text-muted small d-block mb-1">SKU: {{ $item['product']->sku }}</span>
                                @endif
                                <strong class="text-purple-deep">
                                    ₹{{ number_format($item['price'], 2) }}
                                </strong>
                            </div>

                            {{-- Quantity Stepper Form --}}
                            <div class="col-7 col-sm-3">
                                <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="cart_key" value="{{ $item['cart_key'] ?? $item['product']->id }}">
                                    <div class="cart-qty-wrap d-flex align-items-center border border-gold-light rounded-pill p-1">
                                        <input type="number" 
                                               name="quantity" 
                                               value="{{ $item['quantity'] }}" 
                                               min="1" 
                                               max="{{ isset($item['variant']) && $item['variant'] ? $item['variant']->stock : $item['product']->stock }}" 
                                               class="form-control form-control-sm text-center border-0 bg-transparent fw-bold text-purple-deep" 
                                               style="width: 50px;" 
                                               required>
                                        <button type="submit" class="btn btn-sm btn-update-qty rounded-pill px-2" title="Update Quantity">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>
                                    </div>
                                </form>
                                <span class="d-block text-muted small mt-1">
                                    Item Total: <strong class="text-purple-deep">₹{{ number_format($item['total'], 2) }}</strong>
                                </span>
                            </div>

                            {{-- Remove Button --}}
                            <div class="col-5 col-sm-2 text-end">
                                <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="cart_key" value="{{ $item['cart_key'] ?? $item['product']->id }}">
                                    <button type="submit" class="btn-cart-remove" title="Remove from bag" aria-label="Remove item">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Continue Shopping Link --}}
                <div class="mt-4">
                    <a href="{{ route('shop') }}" class="btn-continue-shopping d-inline-flex align-items-center">
                        <i class="bi bi-arrow-left me-2"></i>
                        <span>Explore More Haute Silhouettes</span>
                    </a>
                </div>
            </div>

            {{-- Order Summary Card (Right Column) --}}
            <div class="col-lg-4" data-motion="fade-left">
                <div class="cart-summary-card p-4 rounded-4 bg-white border border-gold-light shadow-sm" data-tilt="true">
                    <h4 class="summary-title pb-3 mb-3 border-bottom border-gold-light">
                        <i class="bi bi-receipt text-gold me-2"></i> Order Summary
                    </h4>

                    <div class="d-flex justify-content-between mb-3 text-muted small">
                        <span>Bag Subtotal</span>
                        <strong class="text-purple-deep fs-6">₹{{ number_format($subtotal, 2) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-muted small">
                        <span>Complimentary Courier</span>
                        <strong class="text-success"><i class="bi bi-patch-check-fill me-1"></i> FREE</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-muted small">
                        <span>Boutique Luxury Packaging</span>
                        <strong class="text-gold-dark">Included</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 mt-2 border-top border-gold-primary mb-4">
                        <div>
                            <span class="d-block small text-muted text-uppercase letter-spacing-1 fw-bold">Estimated Total</span>
                            <small class="text-muted" style="font-size: 0.72rem;">Inclusive of all Indian taxes</small>
                        </div>
                        <div class="text-end">
                            <span class="fs-4 fw-bold text-purple-deep">₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>

                    {{-- Proceed to Checkout Button --}}
                    <a href="{{ route('checkout.index') }}" class="btn-royal-gold-checkout magnetic-btn w-100 mb-3 text-decoration-none">
                        <i class="bi bi-lock-fill me-2 text-purple-deep"></i>
                        <span>PROCEED TO CHECKOUT</span>
                        <div class="btn-shimmer-sweep"></div>
                    </a>

                    <p class="small text-muted text-center mt-3 mb-0">
                        <i class="bi bi-shield-check text-success me-1"></i> 256-Bit SSL Encrypted Secure Checkout
                    </p>
                </div>
            </div>

        </div>

        @else
        {{-- Empty Bag State --}}
        <div class="cart-empty-box text-center p-5 rounded-4 bg-white border border-gold-light shadow-sm" data-motion="zoom-in">
            <div class="empty-crest-wrap mb-4">
                <div class="empty-crest-icon">
                    <i class="bi bi-bag"></i>
                </div>
            </div>
            <span class="text-gold fw-bold letter-spacing-2 small text-uppercase">
                ✦ ATELIER BAG ✦
            </span>
            <h3 class="mt-2 mb-2 fw-bold text-purple-deep">Your Shopping Bag Is Empty</h3>
            <p class="text-muted mx-auto mb-4" style="max-width: 520px;">
                You haven't added any handloom silhouettes to your bag yet. Discover our celebratory silk weaves, chanderi drapes, and designer bridal gowns.
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

    .boutique-cart-hero {
        background: radial-gradient(circle at 75% 25%, #451b47 0%, #2e102f 50%, #1a081b 100%);
        color: #ffffff;
        padding-top: 20px;
        padding-bottom: 25px;
    }

    .cart-ambient-glow {
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

    .cart-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(212, 175, 55, 0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        opacity: 0.5;
    }

    .cart-luxury-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.82rem;
        transition: color 0.3s ease;
    }

    .cart-luxury-breadcrumb .breadcrumb-item a:hover {
        color: var(--gold-primary);
    }

    .cart-luxury-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(212, 175, 55, 0.6);
        content: "✦";
        font-size: 0.65rem;
        padding: 0 10px;
    }

    .cart-royal-pill {
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

    .cart-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 3.2vw, 3rem);
        font-weight: 700;
        color: #ffffff;
    }

    .stepper-progress-bar {
        width: 100%;
        height: 5px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 5px;
        overflow: hidden;
    }

    .stepper-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #F3E5AB, #D4AF37);
        border-radius: 5px;
    }

    .bg-glass {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
    }

    .border-gold-subtle {
        border-color: rgba(212, 175, 55, 0.2) !important;
    }

    .cart-main-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
    }

    .cart-item-card {
        border: 1px solid rgba(212, 175, 55, 0.25);
        transition: transform 0.3s var(--ease-luxury), box-shadow 0.3s var(--ease-luxury);
    }

    .cart-item-card:hover {
        box-shadow: 0 15px 35px rgba(46, 16, 47, 0.1) !important;
    }

    .cart-item-img {
        width: 100%;
        height: 90px;
        object-fit: cover;
    }

    .cart-item-name {
        font-size: 1rem;
        font-weight: 600;
    }

    .btn-update-qty {
        background: var(--purple-deep);
        color: var(--gold-light);
        border: none;
        padding: 4px 8px;
        font-size: 0.78rem;
    }

    .btn-update-qty:hover {
        background: var(--gold-primary);
        color: var(--purple-deep);
    }

    .btn-cart-remove {
        background: transparent;
        border: 1px solid rgba(194, 24, 91, 0.25);
        color: #c2185b;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-cart-remove:hover {
        background: #c2185b;
        color: #ffffff;
        transform: scale(1.1);
    }

    .btn-continue-shopping {
        color: var(--purple-deep);
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .btn-continue-shopping:hover {
        color: var(--gold-dark);
    }

    .cart-summary-card {
        border: 1.5px solid rgba(212, 175, 55, 0.35);
        position: sticky;
        top: 90px;
    }

    .summary-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .btn-royal-gold-checkout {
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

    .btn-royal-gold-checkout:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 14px 30px rgba(212, 175, 55, 0.6);
        color: #1a081b;
    }

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
