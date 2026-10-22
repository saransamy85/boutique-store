@extends('frontend.layouts.app')

@php
$brand = 'Kathirazhagi Boutique';
@endphp

@section('title', 'Secure Checkout | ' . $brand)
@section('meta_description', 'Complete your bespoke boutique handloom silk and gown order securely at ' . $brand . '.')

@section('content')

{{-- ===================================================
    1. HAUTE EDITORIAL CHECKOUT BANNER & STEPPER
=================================================== --}}
<section class="boutique-checkout-hero position-relative overflow-hidden">
    {{-- Ambient Radiant Glow Orbs --}}
    <div class="checkout-ambient-glow glow-gold"></div>
    <div class="checkout-ambient-glow glow-berry"></div>
    <div class="checkout-grid-pattern"></div>

    <div class="container position-relative z-2 py-4">
        {{-- Breadcrumb Trail --}}
        <nav aria-label="breadcrumb" data-motion="fade-down" data-motion-delay="100">
            <ol class="breadcrumb checkout-luxury-breadcrumb mb-3">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('cart.index') }}">
                        Shopping Bag
                    </a>
                </li>
                <li class="breadcrumb-item active text-gold fw-semibold" aria-current="page">
                    Secure Checkout
                </li>
            </ol>
        </nav>

        {{-- Checkout Header Title & Eyebrow --}}
        <div class="row align-items-center g-4">
            <div class="col-lg-8" data-motion="fade-right" data-motion-duration="900">
                <div class="checkout-royal-pill mb-2">
                    <span class="pill-sparkle"><i class="bi bi-shield-lock-fill"></i></span>
                    <span class="pill-text">256-BIT ENCRYPTED ATELIER CHECKOUT</span>
                    <span class="pill-divider">•</span>
                    <span class="pill-sub">VERIFIED PATRON DISPATCH</span>
                </div>

                <h1 class="checkout-hero-title mb-2">
                    Finalize Your <span class="gold-gradient-text">Haute Order.</span>
                </h1>
                <p class="checkout-hero-lead mb-0 text-white-80">
                    Provide your delivery destination and select your preferred payment privilege to reserve your handcrafted handloom pieces.
                </p>
            </div>

            {{-- 3-Step Process Indicator on Hero Right --}}
            <div class="col-lg-4" data-motion="fade-left" data-motion-delay="150">
                <div class="checkout-steps-badge-wrap p-3 rounded-4 bg-glass border border-gold-subtle">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="step-label text-gold small fw-bold letter-spacing-1">ORDER PROGRESS</span>
                        <span class="step-num text-white-50 small">Step 2 of 3</span>
                    </div>
                    <div class="stepper-progress-bar mb-2">
                        <div class="stepper-progress-fill"></div>
                    </div>
                    <div class="d-flex justify-content-between text-white-75 small">
                        <span><i class="bi bi-check-circle-fill text-gold me-1"></i> Bag</span>
                        <span class="text-white fw-bold"><i class="bi bi-dot text-gold"></i> Shipping</span>
                        <span class="text-white-50">Confirmation</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    2. MAIN CHECKOUT FORM & ORDER SUMMARY
=================================================== --}}
<section class="checkout-main-section py-5 position-relative">
    <div class="container">

        @if($errors->any())
        <div class="alert alert-danger checkout-alert-error mb-4 rounded-4 border-0 p-3 shadow-sm" data-motion="fade-down">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5 text-danger"></i>
                <div>
                    <strong>Please review the highlighted details:</strong>
                    <ul class="mb-0 mt-1 small">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" id="checkoutForm">
            @csrf

            <div class="row g-4 g-lg-5 align-items-start">

                {{-- Left Column: Patron Details, Shipping Address, Payment Method --}}
                <div class="col-lg-7" data-motion="fade-right">

                    {{-- Step 1: Patron Information Card --}}
                    <div class="checkout-luxury-card mb-4" data-tilt="true">
                        <div class="card-step-badge mb-3">
                            <span class="step-number">1</span>
                            <h3 class="card-step-title mb-0">Patron Information</h3>
                        </div>

                        <div class="mb-3">
                            <label class="checkout-input-label">Full Name <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="bi bi-person text-gold"></i>
                                <input type="text" 
                                       name="customer_name" 
                                       class="form-control luxury-form-input @error('customer_name') is-invalid @enderror" 
                                       placeholder="e.g. Priyadarshini Sundaram" 
                                       value="{{ old('customer_name') }}" 
                                       required>
                            </div>
                            @error('customer_name')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="checkout-input-label">Email Address <span class="text-danger">*</span></label>
                                <div class="input-with-icon">
                                    <i class="bi bi-envelope text-gold"></i>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control luxury-form-input @error('email') is-invalid @enderror" 
                                           placeholder="patron@example.com" 
                                           value="{{ old('email') }}" 
                                           required>
                                </div>
                                @error('email')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="checkout-input-label">Mobile Number <span class="text-danger">*</span></label>
                                <div class="input-with-icon">
                                    <i class="bi bi-telephone text-gold"></i>
                                    <input type="tel" 
                                           name="phone" 
                                           class="form-control luxury-form-input @error('phone') is-invalid @enderror" 
                                           placeholder="e.g. 9876543210" 
                                           value="{{ old('phone') }}" 
                                           required>
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">For order updates & courier SMS tracking</small>
                                @error('phone')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Step 2: Shipping Destination Card --}}
                    <div class="checkout-luxury-card mb-4" data-tilt="true">
                        <div class="card-step-badge mb-3">
                            <span class="step-number">2</span>
                            <h3 class="card-step-title mb-0">Delivery Address</h3>
                        </div>

                        <div class="mb-3">
                            <label class="checkout-input-label">Street / House / Flat / Landmark <span class="text-danger">*</span></label>
                            <div class="input-with-icon-textarea">
                                <i class="bi bi-geo-alt text-gold"></i>
                                <textarea name="address" 
                                          class="form-control luxury-form-textarea @error('address') is-invalid @enderror" 
                                          rows="3" 
                                          placeholder="Door number, apartment name, street, nearby temple or landmark..." 
                                          required>{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="checkout-input-label">City / Town <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="city" 
                                       class="form-control luxury-form-input @error('city') is-invalid @enderror" 
                                       placeholder="e.g. Chennai" 
                                       value="{{ old('city') }}" 
                                       required>
                                @error('city')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="checkout-input-label">State / Province <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="state" 
                                       class="form-control luxury-form-input @error('state') is-invalid @enderror" 
                                       placeholder="e.g. Tamil Nadu" 
                                       value="{{ old('state') }}" 
                                       required>
                                @error('state')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="checkout-input-label">Postal Pincode <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="pincode" 
                                       class="form-control luxury-form-input @error('pincode') is-invalid @enderror" 
                                       placeholder="e.g. 600001" 
                                       value="{{ old('pincode') }}" 
                                       required>
                                @error('pincode')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Optional Order Notes & Blouse Stitching Instructions --}}
                        <div class="mt-3">
                            <label class="checkout-input-label d-flex justify-content-between">
                                <span>Order Notes / Custom Blouse Stitching Details (Optional)</span>
                                <span class="text-muted small">Special Requests</span>
                            </label>
                            <textarea name="notes" 
                                      class="form-control luxury-form-textarea" 
                                      rows="2" 
                                      placeholder="Mention any drape preferences, wedding dates, or blouse stitching notes...">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    {{-- Step 3: Payment Method Card --}}
                    <div class="checkout-luxury-card mb-4" data-tilt="true">
                        <div class="card-step-badge mb-3">
                            <span class="step-number">3</span>
                            <h3 class="card-step-title mb-0">Payment Privilege</h3>
                        </div>

                        {{-- Interactive Payment Method Selectors --}}
                        <div class="row g-3 mb-4">
                            {{-- Option 1: Cash on Delivery --}}
                            <div class="col-md-6">
                                <label class="payment-option-card d-block cursor-pointer position-relative">
                                    <input type="radio" 
                                           name="payment_method" 
                                           id="paymentCod" 
                                           value="cod" 
                                           class="d-none payment-radio" 
                                           checked>
                                    <div class="payment-card-inner p-3 rounded-4 border border-gold-light">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="payment-icon-wrap">
                                                <i class="bi bi-cash-stack text-gold fs-4"></i>
                                            </div>
                                            <span class="payment-radio-indicator"></span>
                                        </div>
                                        <h5 class="payment-title mb-1">Cash on Delivery</h5>
                                        <p class="payment-sub mb-0 text-muted small">Pay in cash or UPI upon courier arrival at your doorstep.</p>
                                    </div>
                                </label>
                            </div>

                            {{-- Option 2: Instant Online UPI / QR Code --}}
                            <div class="col-md-6">
                                <label class="payment-option-card d-block cursor-pointer position-relative">
                                    <input type="radio" 
                                           name="payment_method" 
                                           id="paymentOnline" 
                                           value="online" 
                                           class="d-none payment-radio">
                                    <div class="payment-card-inner p-3 rounded-4 border border-gold-light">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="payment-icon-wrap">
                                                <i class="bi bi-qr-code-scan text-gold fs-4"></i>
                                            </div>
                                            <span class="payment-radio-indicator"></span>
                                        </div>
                                        <h5 class="payment-title mb-1">Instant UPI & QR Code</h5>
                                        <p class="payment-sub mb-0 text-muted small">Scan UPI QR directly using GPay, PhonePe, or Paytm.</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Collapsible Online Payment Details (Scan QR & Upload Screenshot) --}}
                        <div id="onlinePaymentDetails" class="online-payment-box p-4 rounded-4 mb-3 border border-gold-primary" style="display: none;">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-stars text-gold fs-5"></i>
                                <h5 class="mb-0 text-white fw-bold">Scan QR Code to Complete Payment</h5>
                            </div>

                            <div class="row align-items-center g-4 mb-4">
                                {{-- QR Code Frame --}}
                                <div class="col-md-5 text-center">
                                    <div class="qr-luxury-frame p-3 rounded-4 bg-white text-center shadow-sm">
                                        <i class="bi bi-qr-code text-purple-deep" style="font-size: 7.5rem; line-height: 1;"></i>
                                        <div class="qr-brand-label mt-2 text-uppercase fw-bold text-gold-dark small letter-spacing-1">
                                            KATHIRAZHAGI UPI
                                        </div>
                                        <small class="text-muted d-block mt-1">Accepts GPay • PhonePe • Paytm</small>
                                    </div>
                                </div>

                                {{-- Bank Account Details --}}
                                <div class="col-md-7">
                                    <div class="bank-details-card p-3 rounded-4 bg-glass border border-gold-subtle text-white small">
                                        <div class="mb-2 pb-2 border-bottom border-white-10">
                                            <span class="text-white-50 d-block">Bank Name</span>
                                            <strong class="text-white">State Bank of India</strong>
                                        </div>
                                        <div class="mb-2 pb-2 border-bottom border-white-10">
                                            <span class="text-white-50 d-block">Account Name</span>
                                            <strong class="text-gold">KATHIRAZHAGI BOUTIQUE</strong>
                                        </div>
                                        <div class="mb-2 pb-2 border-bottom border-white-10">
                                            <span class="text-white-50 d-block">Account Number</span>
                                            <strong class="text-white font-monospace">1234567890</strong>
                                        </div>
                                        <div>
                                            <span class="text-white-50 d-block">IFSC Code</span>
                                            <strong class="text-gold font-monospace">SBIN0001234</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Payment Screenshot Upload Zone --}}
                            <div class="screenshot-upload-zone">
                                <label class="checkout-input-label text-white mb-2">
                                    Upload Payment Confirmation Screenshot <span class="text-danger">*</span>
                                </label>
                                <div class="custom-file-upload-box p-3 rounded-4 border border-dashed border-gold-light text-center">
                                    <i class="bi bi-cloud-arrow-up-fill text-gold fs-2 mb-2 d-block"></i>
                                    <input type="file" 
                                           name="payment_screenshot" 
                                           id="paymentScreenshotInput" 
                                           class="form-control luxury-file-input" 
                                           accept="image/*">
                                    <small class="text-white-75 d-block mt-2">
                                        PNG, JPG, or JPEG up to 2MB. Upload receipt or transaction reference.
                                    </small>
                                </div>
                                @error('payment_screenshot')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                </div>

                {{-- Right Column: Haute Order Summary Card (Sticky) --}}
                <div class="col-lg-5" data-motion="fade-left">
                    <div class="checkout-summary-sticky">
                        <div class="checkout-summary-card p-4 rounded-4" data-tilt="true">
                            <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom border-gold-light">
                                <h4 class="summary-title mb-0">
                                    <i class="bi bi-bag-check-fill text-gold me-2"></i> Your Order
                                </h4>
                                <span class="badge-item-count">{{ count($cartItems) }} {{ count($cartItems) === 1 ? 'Silhouette' : 'Silhouettes' }}</span>
                            </div>

                            {{-- Itemized List --}}
                            <div class="checkout-items-list mb-3">
                                @foreach($cartItems as $item)
                                <div class="checkout-item-row d-flex align-items-center gap-3 py-3 border-bottom border-gold-subtle">
                                    {{-- Product Thumbnail --}}
                                    <div class="checkout-item-thumb rounded-3 overflow-hidden border border-gold-light flex-shrink-0">
                                        <img src="{{ asset($item['product']->image) }}" 
                                             alt="{{ $item['product']->name }}" 
                                             class="item-img img-fluid">
                                    </div>

                                    {{-- Product Name & Qty --}}
                                    <div class="checkout-item-details flex-grow-1">
                                        <h6 class="item-title mb-1 text-purple-deep">
                                            {{ $item['product']->name }}
                                        </h6>
                                        <div class="item-meta d-flex align-items-center gap-2 text-muted small">
                                            <span>Qty: <strong>{{ $item['quantity'] }}</strong></span>
                                            <span>•</span>
                                            <span>₹{{ number_format($item['price'], 2) }} each</span>
                                        </div>
                                    </div>

                                    {{-- Item Total --}}
                                    <div class="checkout-item-price text-end flex-shrink-0">
                                        <strong class="item-total-val text-purple-deep">
                                            ₹{{ number_format($item['item_total'], 2) }}
                                        </strong>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- Financial Breakdown --}}
                            <div class="pricing-breakdown-box py-2 mb-3">
                                <div class="d-flex justify-content-between mb-2 text-muted small">
                                    <span>Bag Subtotal</span>
                                    <strong class="text-purple-deep">₹{{ number_format($subtotal, 2) }}</strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2 text-muted small">
                                    <span>Complimentary Shipping</span>
                                    <strong class="text-success">
                                        <i class="bi bi-patch-check-fill me-1"></i>
                                        {{ $shipping == 0 ? 'FREE' : '₹'.number_format($shipping, 2) }}
                                    </strong>
                                </div>

                                <div class="d-flex justify-content-between mb-2 text-muted small">
                                    <span>Boutique Luxury Packaging</span>
                                    <strong class="text-gold-dark">Complimentary</strong>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 mt-2 border-top border-gold-primary">
                                    <div>
                                        <span class="d-block small text-muted text-uppercase letter-spacing-1 fw-bold">Order Total</span>
                                        <small class="text-muted" style="font-size: 0.7rem;">Inclusive of all Indian taxes</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="grand-total-val">
                                            ₹{{ number_format($total, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Place Order Action Button --}}
                            <button type="submit" class="btn-royal-gold-checkout magnetic-btn w-100 mb-3" id="placeOrderBtn">
                                <i class="bi bi-lock-fill me-2 text-purple-deep"></i>
                                <span>PLACE ORDER NOW</span>
                                <div class="btn-shimmer-sweep"></div>
                            </button>

                            {{-- Return to Cart Link --}}
                            <a href="{{ route('cart.index') }}" class="btn-return-cart d-flex align-items-center justify-content-center w-100 mb-4">
                                <i class="bi bi-arrow-left me-2"></i>
                                <span>Return to Shopping Bag</span>
                            </a>

                            {{-- Patron Trust Badges --}}
                            <div class="checkout-trust-grid p-3 rounded-4 bg-cream-silk border border-gold-light">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-shield-check text-gold fs-5"></i>
                                    <span class="small fw-semibold text-purple-deep">Authentic South Indian Handloom Guarantee</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-truck text-gold fs-5"></i>
                                    <span class="small fw-semibold text-purple-deep">Dispatched within 24–48 Hours</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-whatsapp text-success fs-5"></i>
                                    <span class="small fw-semibold text-purple-deep">Dedicated Order Support via WhatsApp</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
</section>

{{-- ===================================================
    3. INFINITE GOLDEN RUNWAY MARQUEE RIBBON
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
       1. GLOBAL TOKENS & KEYFRAMES
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

    [data-motion].motion-active {
        opacity: 1 !important;
        transform: translate(0, 0) scale(1) !important;
    }

    .text-gold { color: var(--gold-primary) !important; }
    .text-gold-dark { color: var(--gold-dark) !important; }
    .text-purple-deep { color: var(--purple-deep) !important; }
    .bg-cream-silk { background-color: var(--cream-silk) !important; }
    .border-gold-light { border-color: rgba(212, 175, 55, 0.25) !important; }
    .border-gold-subtle { border-color: rgba(212, 175, 55, 0.15) !important; }
    .border-gold-primary { border-color: var(--gold-primary) !important; }
    .bg-glass { background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); }

    /* ===================================================
       2. HAUTE CHECKOUT HERO
    =================================================== */
    .boutique-checkout-hero {
        background: radial-gradient(circle at 75% 25%, #451b47 0%, #2e102f 50%, #1a081b 100%);
        color: #ffffff;
        padding-top: 20px;
        padding-bottom: 25px;
    }

    .checkout-ambient-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(110px);
        pointer-events: none;
        z-index: 1;
    }

    .glow-gold {
        top: -20%;
        right: 15%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.22) 0%, transparent 70%);
    }

    .glow-berry {
        bottom: -20%;
        left: -10%;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(139, 75, 124, 0.25) 0%, transparent 70%);
    }

    .checkout-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(212, 175, 55, 0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        opacity: 0.5;
    }

    .checkout-luxury-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.82rem;
        transition: color 0.3s ease;
    }

    .checkout-luxury-breadcrumb .breadcrumb-item a:hover {
        color: var(--gold-primary);
    }

    .checkout-luxury-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(212, 175, 55, 0.6);
        content: "✦";
        font-size: 0.65rem;
        padding: 0 10px;
    }

    .checkout-royal-pill {
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

    .checkout-hero-title {
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
        width: 66%;
        height: 100%;
        background: linear-gradient(90deg, #F3E5AB, #D4AF37);
        border-radius: 5px;
    }

    /* ===================================================
       3. MAIN CHECKOUT SECTION & FORMS
    =================================================== */
    .checkout-main-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
    }

    .checkout-luxury-card {
        background: #ffffff;
        border: 1.5px solid rgba(212, 175, 55, 0.3);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 12px 35px rgba(46, 16, 47, 0.06);
        transform-style: preserve-3d;
        transition: transform 0.4s var(--ease-luxury), box-shadow 0.4s var(--ease-luxury);
    }

    .checkout-luxury-card:hover {
        box-shadow: 0 20px 45px rgba(46, 16, 47, 0.12), 0 0 20px rgba(212, 175, 55, 0.15);
    }

    .card-step-badge {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--purple-deep);
        color: var(--gold-light);
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--gold-primary);
    }

    .card-step-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .checkout-input-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--purple-deep);
        margin-bottom: 6px;
    }

    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-with-icon i {
        position: absolute;
        left: 16px;
        font-size: 1rem;
        pointer-events: none;
    }

    .luxury-form-input {
        padding-left: 44px;
        padding-top: 11px;
        padding-bottom: 11px;
        border-radius: 50px;
        border: 1.5px solid rgba(46, 16, 47, 0.14);
        background: #FAF8F1;
        font-size: 0.88rem;
        color: var(--purple-deep);
        transition: all 0.3s ease;
    }

    .luxury-form-input:focus {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        background: #ffffff;
    }

    .input-with-icon-textarea {
        position: relative;
    }

    .input-with-icon-textarea i {
        position: absolute;
        left: 16px;
        top: 14px;
        font-size: 1rem;
        pointer-events: none;
    }

    .luxury-form-textarea {
        padding-left: 44px;
        padding-top: 12px;
        border-radius: 16px;
        border: 1.5px solid rgba(46, 16, 47, 0.14);
        background: #FAF8F1;
        font-size: 0.88rem;
        color: var(--purple-deep);
        transition: all 0.3s ease;
    }

    .luxury-form-textarea:focus {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        background: #ffffff;
    }

    /* Payment Cards */
    .payment-option-card {
        cursor: pointer;
    }

    .payment-card-inner {
        background: #FAF8F1;
        transition: all 0.3s ease;
    }

    .payment-radio:checked + .payment-card-inner {
        background: #ffffff;
        border-color: var(--gold-primary) !important;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.25);
    }

    .payment-radio-indicator {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid rgba(46, 16, 47, 0.3);
        display: inline-block;
        transition: all 0.25s ease;
    }

    .payment-radio:checked + .payment-card-inner .payment-radio-indicator {
        border-color: var(--gold-primary);
        background: var(--purple-deep);
        box-shadow: inset 0 0 0 3px #ffffff;
    }

    .payment-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    /* Online Payment Box */
    .online-payment-box {
        background: radial-gradient(circle at 60% 40%, #451b47 0%, #2e102f 70%, #1b071c 100%);
        color: #ffffff;
        box-shadow: 0 15px 40px rgba(46, 16, 47, 0.3);
    }

    .qr-luxury-frame {
        border: 1.5px solid var(--gold-primary);
    }

    .custom-file-upload-box {
        background: rgba(255, 255, 255, 0.06);
    }

    .luxury-file-input {
        background: #ffffff !important;
        border-radius: 30px;
        font-size: 0.82rem;
        padding: 8px 16px;
    }

    /* ===================================================
       4. ORDER SUMMARY (STICKY)
    =================================================== */
    .checkout-summary-sticky {
        position: sticky;
        top: 90px;
    }

    .checkout-summary-card {
        background: #ffffff;
        border: 1.5px solid rgba(212, 175, 55, 0.35);
        box-shadow: 0 15px 45px rgba(46, 16, 47, 0.08);
        transform-style: preserve-3d;
        transition: transform 0.4s var(--ease-luxury), box-shadow 0.4s var(--ease-luxury);
    }

    .checkout-summary-card:hover {
        box-shadow: 0 25px 60px rgba(46, 16, 47, 0.16);
    }

    .summary-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .badge-item-count {
        background: rgba(212, 175, 55, 0.15);
        color: var(--gold-dark);
        font-size: 0.72rem;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 10px;
    }

    .checkout-item-thumb {
        width: 58px;
        height: 70px;
        background: #FAF8F1;
    }

    .item-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-title {
        font-size: 0.88rem;
        font-weight: 600;
        line-height: 1.3;
    }

    .item-total-val {
        font-size: 0.94rem;
    }

    .grand-total-val {
        font-size: 1.45rem;
        font-weight: 800;
        color: var(--purple-deep);
    }

    .btn-royal-gold-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        border-radius: 50px;
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        font-weight: 800;
        font-size: 0.88rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        border: 1px solid #F3E5AB;
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.45);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.35s var(--ease-luxury);
    }

    .btn-royal-gold-checkout:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 14px 30px rgba(212, 175, 55, 0.65);
        color: #1a081b;
    }

    .btn-return-cart {
        color: #666;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 8px;
        border-radius: 30px;
        border: 1px solid rgba(46, 16, 47, 0.12);
        transition: all 0.25s ease;
    }

    .btn-return-cart:hover {
        color: var(--purple-deep);
        background: #FAF8F1;
        border-color: var(--purple-deep);
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

    /* ===================================================
       5. INFINITE MARQUEE
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
        .checkout-summary-sticky {
            position: static;
        }

        .checkout-luxury-card {
            padding: 22px 18px;
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
        }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });
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
            const maxTilt = 5;
            card.style.transform = `perspective(800px) rotateX(${(-deltaY * maxTilt).toFixed(2)}deg) rotateY(${(deltaX * maxTilt).toFixed(2)}deg) translateY(-3px)`;
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
            this.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
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
    // 4. PAYMENT METHOD TOGGLE
    // ===================================================
    const paymentCod = document.getElementById('paymentCod');
    const paymentOnline = document.getElementById('paymentOnline');
    const onlinePaymentDetails = document.getElementById('onlinePaymentDetails');
    const paymentScreenshotInput = document.getElementById('paymentScreenshotInput');

    function togglePaymentDetails() {
        if (paymentOnline && paymentOnline.checked) {
            onlinePaymentDetails.style.display = 'block';
            onlinePaymentDetails.style.animation = 'fadeIn 0.4s ease';
            if (paymentScreenshotInput) paymentScreenshotInput.required = true;
        } else if (onlinePaymentDetails) {
            onlinePaymentDetails.style.display = 'none';
            if (paymentScreenshotInput) paymentScreenshotInput.required = false;
        }
    }

    if (paymentCod) paymentCod.addEventListener('change', togglePaymentDetails);
    if (paymentOnline) paymentOnline.addEventListener('change', togglePaymentDetails);
    togglePaymentDetails();
});
</script>
@endpush
