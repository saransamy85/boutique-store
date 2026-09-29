@extends('frontend.layouts.app')

@section('title', 'Kathirazhaki Boutique | Effortless Style. Every Day.')

@section('meta_description', 'Discover timeless fashion, elegant clothing, new arrivals, and accessories at Luna Boutique.')

@section('content')

{{-- ==========================================
    1. HERO BANNER
========================================== --}}

<section class="luna-hero">
    <div class="container">
        <div class="luna-hero-content">

            <span class="luna-hero-label">
                New Season, New You
            </span>

            <h1>
                Effortless Style.<br>
                Every Day.
            </h1>

            <p>
                Timeless pieces designed to make you
                look and feel your best.
            </p>

            <div class="d-flex flex-wrap gap-2 mt-4">

                <a href="{{ route('shop', ['sort' => 'latest']) }}" class="btn btn-luna">
                    Shop New Arrivals
                </a>

                <a href="{{ route('shop') }}" class="btn btn-luna-outline" style="border-color: #fff; color: #fff;">
                    Shop Dresses
                </a>

            </div>

        </div>
    </div>
</section>

{{-- ==========================================
    CATEGORIES SECTION
========================================== --}}
<section class="luna-categories py-5" style="background-color: #fff;">
    <div class="container">
        <div class="luna-heading text-center mb-5">
            <h2>Shop by Category</h2>
            <span></span>
        </div>
        
        <div class="row row-cols-2 row-cols-md-4 g-4 justify-content-center">
            @forelse($categories as $category)
            <div class="col text-center">
                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="text-decoration-none category-link">
                    <div class="category-img-wrap rounded-circle overflow-hidden mx-auto mb-3" style="width: 150px; height: 150px; border: 2px solid var(--brand-secondary); box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                        @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.4s ease;">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="fw-bold text-uppercase mt-3" style="font-size: 14px; letter-spacing: 1.5px; color: var(--brand-text); transition: color 0.3s ease;">
                        {{ $category->name }}
                    </h5>
                </a>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                No categories available.
            </div>
            @endforelse
        </div>
    </div>
</section>

@push('styles')
<style>
    .category-link:hover .category-img-wrap {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4) !important; /* Gold shadow */
    }
    .category-link:hover h5 {
        color: var(--brand-secondary) !important;
    }
    .category-link:hover img {
        transform: scale(1.1);
    }
</style>
@endpush


{{-- ==========================================
    2. SHOPPING BENEFITS
========================================== --}}

<section class="luna-benefits">

    <div class="container">

        <div class="row">

            <div class="col-6 col-lg-3">

                <div class="luna-benefit-item">

                    <i class="bi bi-truck"></i>

                    <div>
                        <h6>Free Shipping</h6>
                        <p>On orders over ₹999</p>
                    </div>

                </div>

            </div>

            <div class="col-6 col-lg-3">

                <div class="luna-benefit-item">

                    <i class="bi bi-arrow-repeat"></i>

                    <div>
                        <h6>Easy Returns</h6>
                        <p>7-day hassle-free returns</p>
                    </div>

                </div>

            </div>

            <div class="col-6 col-lg-3">

                <div class="luna-benefit-item">

                    <i class="bi bi-heart"></i>

                    <div>
                        <h6>Long Lasting</h6>
                        <p>Fashion made for you</p>
                    </div>

                </div>

            </div>

            <div class="col-6 col-lg-3">

                <div class="luna-benefit-item">

                    <i class="bi bi-lock"></i>

                    <div>
                        <h6>Secure Checkout</h6>
                        <p>Safe & trusted payments</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ==========================================
    3. NEW ARRIVALS
========================================== --}}

<section class="luna-new-arrivals">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="flex-grow-1 text-center">

                <div class="luna-heading mb-0">

                    <h2>New Arrivals</h2>

                    <span></span>

                </div>

            </div>

            <a href="{{ route('shop', ['sort' => 'latest']) }}" class="luna-text-link d-none d-md-inline-block">

                Shop All New <i class="bi bi-arrow-right"></i>

            </a>

        </div>


        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 g-lg-4">

            @forelse($newArrivals->take(5) as $product)

            <div class="col">

                <div class="luna-product-card">

                    {{-- PRODUCT IMAGE --}}

                    <a href="{{ route('product.details', $product->slug) }}">

                        <div class="luna-product-img-wrap">

                            @if($product->sale_price !== null && $product->sale_price < $product->price)

                                <span class="luna-product-badge">
                                    Sale
                                </span>

                                @else

                                <span class="luna-product-badge">
                                    New
                                </span>

                                @endif


                                @if($product->image)

                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="luna-product-img" loading="lazy">

                                @else

                                <div class="luna-product-img d-flex align-items-center justify-content-center">

                                    <i class="bi bi-image fs-1 text-secondary"></i>

                                </div>

                                @endif

                        </div>

                    </a>


                    {{-- PRODUCT INFO --}}

                    <div class="luna-product-info">

                        <a href="{{ route('product.details', $product->slug) }}" class="luna-product-name d-block">

                            {{ $product->name }}

                        </a>


                        <div class="luna-product-price">

                            ₹{{ number_format((float) ($product->sale_price ?? $product->price), 2) }}

                            @if($product->sale_price !== null && $product->sale_price < $product->price)

                                <span class="luna-product-old-price">

                                    ₹{{ number_format((float) $product->price, 2) }}

                                </span>

                                @endif

                        </div>


                        {{-- Decorative color indicators --}}

                        <div class="luna-product-colors">

                            <span class="luna-color-dot" style="background:#d6c7b2"></span>

                            <span class="luna-color-dot" style="background:#7d8263"></span>

                            <span class="luna-color-dot" style="background:#292929"></span>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-12 text-center py-5">

                <p class="text-muted">
                    New arrivals will be available soon.
                </p>

                <a href="{{ route('shop') }}" class="btn btn-luna">
                    Explore Shop
                </a>

            </div>

            @endforelse

        </div>


        <div class="text-center mt-4 d-md-none">

            <a href="{{ route('shop', ['sort' => 'latest']) }}" class="luna-text-link">

                Shop All New <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </div>

</section>


{{-- ==========================================
    4. PROMOTIONAL BANNERS (CURATED COLLECTIONS)
========================================== --}}
<section class="container pb-5 pt-5">
    <div class="luna-heading text-center mb-5">
        <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">Curated Collections</h2>
        <div class="heading-line mx-auto"></div>
    </div>

    <div class="row g-4 justify-content-center">
        {{-- SUMMER ESSENTIALS --}}
        <div class="col-md-6">
            <a href="{{ route('shop') }}" class="curated-card">
                <img src="https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1000&q=85" alt="Summer Essentials" class="curated-img">
                <div class="curated-overlay"></div>
                <div class="curated-content">
                    <span class="curated-badge">Sunny Days Ahead</span>
                    <h3 class="curated-title">Summer Essentials</h3>
                    <p class="curated-desc">Light layers. Beautiful moments. Elevate your sunny days.</p>
                    <span class="curated-action">Shop Collection <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
        </div>

        {{-- ACCESSORIES --}}
        <div class="col-md-6">
            <a href="{{ route('shop') }}" class="curated-card">
                <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1000&q=85" alt="Accessories" class="curated-img">
                <div class="curated-overlay"></div>
                <div class="curated-content">
                    <span class="curated-badge">The Finishing Touch</span>
                    <h3 class="curated-title">Accessorize Your Look</h3>
                    <p class="curated-desc">Elevate every outfit with timeless details and modern elegance.</p>
                    <span class="curated-action">Shop Accessories <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
        </div>
    </div>
</section>

@push('styles')
<style>
    .heading-line {
        width: 60px;
        height: 3px;
        background-color: var(--brand-secondary, #d4af37);
        margin-top: 10px;
        transition: width 0.3s ease;
    }
    .luna-heading:hover .heading-line {
        width: 100px;
    }
    .curated-card {
        position: relative;
        display: block;
        border-radius: 16px;
        overflow: hidden;
        aspect-ratio: 4/5;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        text-decoration: none;
    }
    @media(min-width: 768px) {
        .curated-card { aspect-ratio: 16/10; }
    }
    .curated-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .curated-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 15, 15, 0.85) 0%, rgba(15, 15, 15, 0.2) 50%, transparent 100%);
        opacity: 0.8;
        transition: opacity 0.4s ease;
    }
    .curated-content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 40px;
        color: #fff;
        z-index: 2;
        transform: translateY(20px);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .curated-badge {
        display: inline-block;
        padding: 6px 12px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-radius: 30px;
        margin-bottom: 20px;
        border: 1px solid rgba(255,255,255,0.3);
    }
    .curated-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 15px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .curated-desc {
        font-size: 1rem;
        opacity: 0;
        margin-bottom: 25px;
        max-width: 80%;
        transform: translateY(15px);
        transition: opacity 0.4s ease, transform 0.4s ease;
        transition-delay: 0.1s;
    }
    .curated-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 0.85rem;
        color: #fff;
        border-bottom: 2px solid transparent;
        padding-bottom: 4px;
        transition: border-color 0.3s ease, gap 0.3s ease;
    }
    .curated-card:hover .curated-img {
        transform: scale(1.05);
    }
    .curated-card:hover .curated-overlay {
        opacity: 1;
        background: linear-gradient(to top, rgba(15, 15, 15, 0.95) 0%, rgba(15, 15, 15, 0.4) 50%, rgba(15, 15, 15, 0.1) 100%);
    }
    .curated-card:hover .curated-content {
        transform: translateY(0);
    }
    .curated-card:hover .curated-desc {
        opacity: 1;
        transform: translateY(0);
    }
    .curated-card:hover .curated-action {
        gap: 15px;
        border-color: var(--brand-secondary, #d4af37);
        color: var(--brand-secondary, #d4af37);
    }
</style>
@endpush


{{-- ==========================================
    5. KATHIRAZHAGI REWARDS
========================================== --}}
<section class="py-5 my-5" style="position: relative; background-color: #faf9f7;">
    <div class="container">
        <div class="rewards-wrapper p-4 p-md-5 rounded-4 position-relative overflow-hidden">
            <div class="rewards-bg-glow"></div>
            
            <div class="row align-items-center position-relative z-1 g-4 text-center text-md-start">
                <div class="col-12 col-lg-3 mb-4 mb-lg-0 border-end-lg border-white-50">
                    <h3 class="text-white fw-bold mb-2" style="font-size: 2rem;">Kathirazhagi <br><span style="color: var(--brand-secondary, #d4af37);">Rewards</span></h3>
                    <p class="text-white-50 mb-0">Experience fashion with exclusive perks.</p>
                </div>
                
                <div class="col-12 col-lg-9">
                    <div class="row g-4">
                        {{-- JOIN REWARDS --}}
                        <div class="col-md-4">
                            <div class="reward-feature-card">
                                <div class="reward-icon-box">
                                    <i class="bi bi-gift-fill"></i>
                                </div>
                                <h6 class="text-white fw-semibold mb-2">Join Rewards</h6>
                                <p class="text-white-50 small mb-3">Earn points, unlock perks and special member offers.</p>
                                <a href="{{ route('shop') }}" class="reward-link">Join Now <i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>

                        {{-- GET 10% OFF --}}
                        <div class="col-md-4">
                            <div class="reward-feature-card">
                                <div class="reward-icon-box">
                                    <i class="bi bi-envelope-paper-heart-fill"></i>
                                </div>
                                <h6 class="text-white fw-semibold mb-2">Get 10% Off</h6>
                                <p class="text-white-50 small mb-3">Sign up for our newsletter to get instant discount.</p>
                                <a href="#luna-newsletter" class="reward-link">Sign Up Now <i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>

                        {{-- LOVE LUNA --}}
                        <div class="col-md-4">
                            <div class="reward-feature-card">
                                <div class="reward-icon-box">
                                    <i class="bi bi-stars"></i>
                                </div>
                                <h6 class="text-white fw-semibold mb-2">Love Kathirazhagi</h6>
                                <p class="text-white-50 small mb-3">Find a timeless style that feels uniquely like you.</p>
                                <a href="{{ route('shop') }}" class="reward-link">Explore More <i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .rewards-wrapper {
        background-color: var(--brand-primary, #2e102f);
        box-shadow: 0 25px 50px -12px rgba(46, 16, 47, 0.4);
    }
    @media(min-width: 992px) {
        .border-end-lg {
            border-right: 1px solid rgba(255,255,255,0.1);
        }
    }
    .rewards-bg-glow {
        position: absolute;
        top: -50%;
        left: -20%;
        width: 140%;
        height: 200%;
        background: radial-gradient(circle at 80% 20%, rgba(212, 175, 55, 0.15) 0%, transparent 40%),
                    radial-gradient(circle at 20% 80%, rgba(212, 175, 55, 0.1) 0%, transparent 40%);
        z-index: 0;
        pointer-events: none;
    }
    .reward-feature-card {
        padding: 20px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: transform 0.3s ease, background 0.3s ease, border-color 0.3s ease;
        height: 100%;
    }
    .reward-feature-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(212, 175, 55, 0.3);
    }
    .reward-icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(212,175,55,0.2) 0%, rgba(212,175,55,0.05) 100%);
        color: var(--brand-secondary, #d4af37);
        font-size: 1.5rem;
        margin-bottom: 20px;
        border: 1px solid rgba(212, 175, 55, 0.2);
    }
    .reward-link {
        color: var(--brand-secondary, #d4af37);
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: color 0.3s ease;
    }
    .reward-link i {
        font-size: 0.75rem;
        margin-left: 5px;
        transition: margin-left 0.3s ease;
    }
    .reward-link:hover {
        color: #fff;
    }
    .reward-link:hover i {
        margin-left: 10px;
    }
</style>
@endpush


{{-- ==========================================
    6. CONTACT US
========================================== --}}
<section class="container py-5 mb-5" id="contact-us">
    <div class="luna-heading text-center mb-5">
        <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">Get in Touch</h2>
        <div class="heading-line mx-auto"></div>
    </div>

    <div class="contact-showcase shadow-lg rounded-4 overflow-hidden position-relative">
        <div class="row g-0">
            {{-- India Address --}}
            <div class="col-md-6 position-relative p-5 contact-pane bg-white">
                <div class="contact-icon-wrapper mb-4">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h3 class="contact-region-title mb-4">India Headquarters</h3>
                
                <ul class="list-unstyled contact-details">
                    <li class="d-flex mb-3">
                        <i class="bi bi-building text-muted me-3 mt-1"></i>
                        <span>1/150 Agaraharam Street,<br>Mullippallam,<br>Sholavanthan</span>
                    </li>
                    <li class="d-flex">
                        <i class="bi bi-mailbox text-muted me-3 mt-1"></i>
                        <span>Pincode 625207</span>
                    </li>
                </ul>
            </div>

            {{-- Divider for Desktop --}}
            <div class="d-none d-md-block position-absolute top-50 start-50 translate-middle" style="z-index: 5; height: 70%; width: 1px; background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.1), transparent);"></div>
            {{-- Divider for Mobile --}}
            <div class="d-md-none w-100" style="height: 1px; background: linear-gradient(to right, transparent, rgba(0,0,0,0.1), transparent);"></div>

            {{-- UK Address --}}
            <div class="col-md-6 position-relative p-5 contact-pane" style="background-color: #f8f9fa;">
                <div class="contact-icon-wrapper mb-4">
                    <i class="bi bi-globe-americas"></i>
                </div>
                <h3 class="contact-region-title mb-4">UK Location</h3>
                
                <ul class="list-unstyled contact-details">
                    <li class="d-flex mb-3">
                        <i class="bi bi-pin-map text-muted me-3 mt-1"></i>
                        <span>Stafford, UK</span>
                    </li>
                    <li class="d-flex mb-4">
                        <i class="bi bi-telephone text-muted me-3 mt-1"></i>
                        <a href="tel:+447393129732" class="contact-link">+44 7393 129732</a>
                    </li>
                </ul>

                <div class="shipping-badge mt-2">
                    <i class="bi bi-airplane me-2"></i> International Shipping Available
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .contact-showcase {
        border: 1px solid rgba(0,0,0,0.05);
        transition: box-shadow 0.4s ease;
    }
    .contact-showcase:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
    }
    .contact-pane {
        transition: background-color 0.4s ease;
    }
    .contact-pane:hover {
        background-color: #fff !important;
    }
    .contact-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: rgba(212, 175, 55, 0.1);
        color: var(--brand-secondary, #d4af37);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), background-color 0.4s ease;
    }
    .contact-pane:hover .contact-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background-color: var(--brand-secondary, #d4af37);
        color: #fff;
    }
    .contact-region-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--brand-primary, #2e102f);
    }
    .contact-details {
        font-size: 1.05rem;
        color: #555;
    }
    .contact-link {
        color: #555;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .contact-link:hover {
        color: var(--brand-secondary, #d4af37);
    }
    .shipping-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: linear-gradient(135deg, var(--brand-secondary, #d4af37) 0%, #b8962e 100%);
        color: #fff;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
    }
</style>
@endpush


{{-- ==========================================
    7. NEWSLETTER
========================================== --}}

<section class="container py-4" id="luna-newsletter">

    <div class="luna-newsletter">

        <h3>Let's Be Friends</h3>

        <p>
            Get the latest styles, new arrivals and exclusive offers.
        </p>

        <form class="mx-auto mt-3" style="max-width:420px" onsubmit="return false;">

            <div class="input-group">

                <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email address" disabled>

                <button type="button" class="btn btn-luna" disabled>

                    Subscribe

                </button>

            </div>

            <small class="text-muted d-block mt-2">
                Newsletter signup will be enabled in a later step.
            </small>

        </form>

    </div>

</section>

@endsection
