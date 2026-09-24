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

                <a href="{{ route('shop') }}" class="btn btn-luna-outline">

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
    4. PROMOTIONAL BANNERS
========================================== --}}

<section class="container pb-4">

    <div class="row g-3">

        {{-- SUMMER ESSENTIALS --}}

        <div class="col-lg-5">

            <div class="luna-promo luna-promo-summer">

                <div class="luna-promo-content">

                    <span class="luna-hero-label">
                        Sunny Days Ahead
                    </span>

                    <h3>
                        Summer<br>Essentials
                    </h3>

                    <p>
                        Light layers. Beautiful moments.
                    </p>

                    <a href="{{ route('shop') }}" class="luna-text-link">
                        Shop The Collection
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>


        {{-- ACCESSORIES --}}

        <div class="col-lg-7">

            <div class="luna-promo luna-promo-accessories">

                <div class="luna-promo-content">

                    <span class="luna-hero-label">
                        The Finishing Touch
                    </span>

                    <h3>
                        Accessorize<br>Your Look
                    </h3>

                    <p>
                        Elevate every outfit with timeless details.
                    </p>

                    <a href="{{ route('shop') }}" class="luna-text-link">
                        Shop Accessories
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ==========================================
    5. LUNA REWARDS
========================================== --}}

<section class="luna-rewards">

    <div class="container">

        <div class="row align-items-center">

            {{-- JOIN REWARDS --}}

            <div class="col-12 col-md-4">

                <div class="luna-reward-item">

                    <i class="bi bi-gift"></i>

                    <div>

                        <h6>Join Luna Rewards</h6>

                        <p>Earn points, unlock perks and special offers.</p>

                        <a href="{{ route('shop') }}" class="luna-text-link mt-2">
                            Join Now
                        </a>

                    </div>

                </div>

            </div>


            {{-- GET 10% OFF --}}

            <div class="col-12 col-md-4">

                <div class="luna-reward-item">

                    <i class="bi bi-envelope"></i>

                    <div>

                        <h6>Get 10% Off</h6>

                        <p>Sign up for our newsletter and exclusive offers.</p>

                        <a href="#luna-newsletter" class="luna-text-link mt-2">
                            Sign Up Now
                        </a>

                    </div>

                </div>

            </div>


            {{-- LOVE LUNA --}}

            <div class="col-12 col-md-4">

                <div class="luna-reward-item">

                    <i class="bi bi-heart"></i>

                    <div>

                        <h6>Love Luna</h6>

                        <p>Find a style that feels just like you.</p>

                        <a href="{{ route('shop') }}" class="luna-text-link mt-2">
                            Explore More
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ==========================================
    6. CONTACT US
========================================== --}}

<section class="container py-5" id="contact-us">

    <div class="luna-heading text-center mb-4">
        <h2>Contact Us</h2>
        <span></span>
    </div>

    <div class="row justify-content-center g-4">
        
        {{-- India Address --}}
        <div class="col-md-6 col-lg-5 text-center">
            <div class="card border-0 shadow-sm h-100" style="background-color: #f8f9fa;">
                <div class="card-body p-5">
                    <i class="bi bi-geo-alt fs-1 mb-3 d-inline-block" style="color: var(--brand-secondary, #d4af37);"></i>
                    <h4 class="mb-4">Home address for India</h4>
                    <p class="mb-1 fs-5 text-muted">1/150 agaraharam street ,</p>
                    <p class="mb-1 fs-5 text-muted">Mullippallam,</p>
                    <p class="mb-1 fs-5 text-muted">Sholavanthan ,</p>
                    <p class="mb-0 fs-5 text-muted">Pincode 625207</p>
                </div>
            </div>
        </div>

        {{-- UK Address --}}
        <div class="col-md-6 col-lg-5 text-center">
            <div class="card border-0 shadow-sm h-100" style="background-color: #f8f9fa;">
                <div class="card-body p-5">
                    <i class="bi bi-globe fs-1 mb-3 d-inline-block" style="color: var(--brand-secondary, #d4af37);"></i>
                    <h4 class="mb-4">UK Location</h4>
                    <p class="mb-2 fs-5 text-muted"><strong>Location:</strong> Stafford, UK</p>
                    <p class="mb-2 fs-5 text-muted"><strong>Owner No:</strong> <a href="tel:+447393129732" class="text-decoration-none text-muted">+44 7393 129732</a></p>
                    <div class="mt-4">
                        <span class="badge text-uppercase p-2" style="background-color: var(--brand-secondary, #d4af37); font-size: 0.85rem; letter-spacing: 1px;">
                            International Shipping
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>


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
