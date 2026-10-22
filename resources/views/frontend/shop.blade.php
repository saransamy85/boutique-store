@extends('frontend.layouts.app')

@php
$brand = 'Kathirazhagi Boutique';
$activeCategorySlug = request('category');
$activeCategory = $activeCategorySlug ? $categories->firstWhere('slug', $activeCategorySlug) : null;
$pageTitle = $activeCategory ? $activeCategory->name . ' Silhouettes | ' . $brand : 'Haute Couture & Handloom Catalogue | ' . $brand;
@endphp

@section('title', $pageTitle)
@section('meta_description', 'Explore our curated atelier collection of pure handloom silk sarees, chanderi drapes, bridal couture and ethnic gowns at ' . $brand . '.')

@section('content')

{{-- ===================================================
    1. HAUTE EDITORIAL HERO & BREADCRUMB BANNER
=================================================== --}}
<section class="boutique-shop-hero position-relative overflow-hidden">
    {{-- Ambient Radiant Glow Orbs --}}
    <div class="shop-ambient-glow glow-gold"></div>
    <div class="shop-ambient-glow glow-berry"></div>
    <div class="shop-grid-pattern"></div>

    <div class="container position-relative z-2 py-5">
        {{-- Luxury Breadcrumb Trail --}}
        <nav aria-label="breadcrumb" class="mb-4" data-motion="fade-down" data-motion-delay="100">
            <ol class="breadcrumb shop-luxury-breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('shop') }}" class="{{ !$activeCategorySlug ? 'text-gold fw-semibold' : '' }}">
                        Haute Catalogue
                    </a>
                </li>
                @if($activeCategory)
                <li class="breadcrumb-item active text-gold fw-semibold" aria-current="page">
                    {{ $activeCategory->name }}
                </li>
                @endif
            </ol>
        </nav>

        <div class="row align-items-center g-4">
            <div class="col-lg-8" data-motion="fade-right" data-motion-duration="900">
                {{-- Royal Atelier Eyebrow Pill --}}
                <div class="shop-royal-pill mb-3" data-motion="fade-down" data-motion-delay="150">
                    <span class="pill-sparkle"><i class="bi bi-stars"></i></span>
                    <span class="pill-text">HAUTE ATELIER ARCHIVE</span>
                    <span class="pill-divider">•</span>
                    <span class="pill-sub">
                        @if($activeCategory)
                            {{ strtoupper($activeCategory->name) }} EDIT
                        @else
                            ALL HANDLOOM SILHOUETTES
                        @endif
                    </span>
                </div>

                {{-- Editorial Headline --}}
                <h1 class="shop-hero-title mb-3">
                    @if($activeCategory)
                        {{ $activeCategory->name }} <br>
                        <span class="gold-gradient-text">Artisanal Curation.</span>
                    @else
                        Curated Handloom & <br>
                        <span class="gold-gradient-text">Haute Silhouettes.</span>
                    @endif
                </h1>

                {{-- Editorial Lead Subtitle --}}
                <p class="shop-hero-lead mb-4">
                    @if($activeCategory && !empty($activeCategory->description))
                        {{ $activeCategory->description }}
                    @else
                        Immerse yourself in our heirloom repository of authentic Kanchipuram mulberry silks, breathable chanderi suits, and contemporary festive evening gowns handcrafted with timeless devotion.
                    @endif
                </p>

                {{-- Catalog Quick Stats Pill Row --}}
                <div class="shop-stats-strip d-flex flex-wrap align-items-center gap-3">
                    <div class="stat-chip">
                        <i class="bi bi-gem text-gold"></i>
                        <span><strong>{{ $products->total() }}</strong> Silhouettes Available</span>
                    </div>
                    <div class="stat-chip">
                        <i class="bi bi-patch-check-fill text-gold"></i>
                        <span>100% Handloom Certified</span>
                    </div>
                    <div class="stat-chip">
                        <i class="bi bi-box-seam text-gold"></i>
                        <span>Express Delivery Across India & Worldwide</span>
                    </div>
                </div>
            </div>

            {{-- Right Column: Royal Guarantee Seal Card --}}
            <div class="col-lg-4 d-none d-lg-block" data-motion="fade-left" data-motion-delay="200">
                <div class="shop-hero-seal-card position-relative" data-tilt="true">
                    <div class="seal-inner-frame">
                        <div class="seal-header d-flex align-items-center gap-2 mb-2">
                            <span class="seal-star">✦</span>
                            <span class="seal-sub">AUTHENTIC SOUTH ATELIER</span>
                            <span class="seal-star">✦</span>
                        </div>
                        <h4 class="seal-title">KATHIRAZHAGI</h4>
                        <div class="seal-divider"></div>
                        <p class="seal-desc">
                            Every weave is handpicked directly from celebrated master weavers across Kanchipuram, Chanderi & Banaras.
                        </p>
                        <div class="seal-bottom d-flex justify-content-between align-items-center mt-3 pt-3 border-top border-gold-subtle">
                            <span class="seal-badge-tag"><i class="bi bi-shield-check me-1"></i> Silk Mark Pure</span>
                            <a href="#shopCatalogue" class="seal-explore-link">Browse Below <i class="bi bi-arrow-down-short"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick-Select Category Pill Carousel --}}
        <div class="shop-hero-category-carousel mt-4 pt-3 border-top border-white-10" data-motion="fade-up" data-motion-delay="300">
            <div class="carousel-label mb-2 text-white-50 small fw-semibold text-uppercase letter-spacing-1">
                <i class="bi bi-sliders2 me-1 text-gold"></i> Quick Category Select:
            </div>
            <div class="category-pill-track d-flex gap-2 pb-2">
                <a href="{{ route('shop') }}" class="hero-cat-pill {{ !$activeCategorySlug ? 'active' : '' }}">
                    <span class="pill-dot"></span>
                    <span>All Products</span>
                    <span class="pill-count">({{ $products->total() }})</span>
                </a>
                @foreach($categories as $category)
                <a href="{{ route('shop', array_merge(request()->except(['page', 'category']), ['category' => $category->slug])) }}" 
                   class="hero-cat-pill {{ $activeCategorySlug == $category->slug ? 'active' : '' }}">
                    <span class="pill-dot"></span>
                    <span>{{ $category->name }}</span>
                    @if(isset($category->products_count) && $category->products_count > 0)
                    <span class="pill-count">({{ $category->products_count }})</span>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    2. MAIN SHOP CATALOGUE SECTION
=================================================== --}}
<section class="shop-main-section" id="shopCatalogue">
    <div class="container py-5">

        {{-- Glassmorphic Search & Filter Toolbar --}}
        <div class="shop-luxury-toolbar mb-4" data-motion="fade-up">
            <form action="{{ route('shop') }}" method="GET" id="shopToolbarForm" class="w-100">
                <div class="row align-items-center g-3">
                    {{-- Search Input with Gold Accents --}}
                    <div class="col-lg-5 col-md-6">
                        <div class="luxury-search-wrap position-relative">
                            <i class="bi bi-search search-icon text-gold"></i>
                            <input type="text" 
                                   name="search" 
                                   class="form-control luxury-search-input" 
                                   placeholder="Search by silk, zari, motif, color or gown..." 
                                   value="{{ request('search') }}"
                                   aria-label="Search silhouettes">
                            
                            {{-- Preserve selected category --}}
                            @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif

                            @if(request('search'))
                            <a href="{{ route('shop', request()->except(['search', 'page'])) }}" class="search-clear-btn" title="Clear Search">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                            @endif

                            <button type="submit" class="luxury-search-btn magnetic-btn">
                                <span>Search</span>
                            </button>
                        </div>
                    </div>

                    {{-- Sort Dropdown & Quick Actions --}}
                    <div class="col-lg-7 col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-md-end gap-3">
                            {{-- Active Result Count Badge --}}
                            <div class="results-count-chip d-none d-sm-flex align-items-center gap-2">
                                <i class="bi bi-diamond-fill text-gold fs-xs"></i>
                                <span>
                                    Showing <strong>{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong> 
                                    of <strong>{{ $products->total() }}</strong> Silhouettes
                                </span>
                            </div>

                            {{-- Sort Selector --}}
                            <div class="sort-selector-wrap">
                                <label for="sortSelect" class="visually-hidden">Sort By</label>
                                <div class="position-relative">
                                    <i class="bi bi-arrow-down-up sort-icon text-gold"></i>
                                    <select name="sort" id="sortSelect" class="form-select luxury-sort-select" onchange="this.form.submit()">
                                        <option value="">Sort: Featured Default</option>
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                            Latest Arrivals
                                        </option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                            Price: Low to High
                                        </option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                            Price: High to Low
                                        </option>
                                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                                            Alphabetical: A to Z
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Active Filter Tags Row (if filters applied) --}}
                @if(request('search') || request('category') || request('sort'))
                <div class="active-filters-bar d-flex flex-wrap align-items-center gap-2 pt-3 mt-3 border-top border-gold-light">
                    <span class="active-filter-label text-muted small fw-semibold">
                        <i class="bi bi-funnel-fill text-gold me-1"></i> Active Filters:
                    </span>

                    @if(request('category'))
                    @php $cat = $categories->firstWhere('slug', request('category')); @endphp
                    <span class="filter-chip">
                        <span>Category: <strong>{{ $cat ? $cat->name : request('category') }}</strong></span>
                        <a href="{{ route('shop', request()->except(['category', 'page'])) }}" class="filter-chip-remove" title="Remove category filter">
                            <i class="bi bi-x"></i>
                        </a>
                    </span>
                    @endif

                    @if(request('search'))
                    <span class="filter-chip">
                        <span>Keyword: "<strong>{{ request('search') }}</strong>"</span>
                        <a href="{{ route('shop', request()->except(['search', 'page'])) }}" class="filter-chip-remove" title="Remove search filter">
                            <i class="bi bi-x"></i>
                        </a>
                    </span>
                    @endif

                    @if(request('sort'))
                    <span class="filter-chip">
                        <span>Sort: <strong>{{ ucfirst(str_replace('_', ' ', request('sort'))) }}</strong></span>
                        <a href="{{ route('shop', request()->except(['sort', 'page'])) }}" class="filter-chip-remove" title="Remove sorting">
                            <i class="bi bi-x"></i>
                        </a>
                    </span>
                    @endif

                    <a href="{{ route('shop') }}" class="clear-all-pill ms-auto">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Clear All
                    </a>
                </div>
                @endif
            </form>
        </div>

        {{-- Main Two-Column Layout (Sidebar + Product Grid) --}}
        <div class="row g-4 g-lg-5">

            {{-- Left Column: Haute Atelier Sidebar --}}
            <div class="col-lg-3 col-md-4">
                <aside class="shop-editorial-sidebar" data-motion="fade-right">
                    {{-- Categories Navigation Widget --}}
                    <div class="sidebar-box mb-4">
                        <div class="sidebar-box-header d-flex align-items-center justify-content-between mb-3">
                            <h4 class="sidebar-box-title mb-0">
                                <i class="bi bi-collection-fill text-gold me-2"></i> Categories
                            </h4>
                            <span class="badge-cat-count">{{ $categories->count() }}</span>
                        </div>

                        <ul class="luxury-category-menu list-unstyled mb-0">
                            {{-- All Products Option --}}
                            <li class="cat-menu-item">
                                <a href="{{ route('shop') }}" class="cat-menu-link {{ !request('category') ? 'active' : '' }}">
                                    <span class="cat-link-content d-flex align-items-center">
                                        <span class="cat-indicator"></span>
                                        <span class="cat-title">All Silhouettes</span>
                                    </span>
                                    <span class="cat-badge-num">{{ $products->total() }}</span>
                                </a>
                            </li>

                            {{-- Individual Category Links --}}
                            @foreach($categories as $category)
                            <li class="cat-menu-item">
                                <a href="{{ route('shop', array_merge(request()->except('page'), ['category' => $category->slug])) }}" 
                                   class="cat-menu-link {{ request('category') == $category->slug ? 'active' : '' }}">
                                    <span class="cat-link-content d-flex align-items-center">
                                        <span class="cat-indicator"></span>
                                        <span class="cat-title">{{ $category->name }}</span>
                                    </span>
                                    @if(isset($category->products_count))
                                    <span class="cat-badge-num">{{ $category->products_count }}</span>
                                    @endif
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Quick Price Preset Filters --}}
                    <div class="sidebar-box mb-4">
                        <div class="sidebar-box-header mb-3">
                            <h4 class="sidebar-box-title mb-0">
                                <i class="bi bi-tag-fill text-gold me-2"></i> Price Curation
                            </h4>
                        </div>
                        <div class="price-pills-list d-flex flex-column gap-2">
                            <a href="{{ route('shop', ['sort' => 'price_low']) }}" class="price-preset-link {{ request('sort') == 'price_low' ? 'active' : '' }}">
                                <span>Under ₹1,000 (Affordable Grace)</span>
                                <i class="bi bi-arrow-right-short"></i>
                            </a>
                            <a href="{{ route('shop', ['sort' => 'latest']) }}" class="price-preset-link {{ request('sort') == 'latest' ? 'active' : '' }}">
                                <span>Festive Signature Edits</span>
                                <i class="bi bi-arrow-right-short"></i>
                            </a>
                            <a href="{{ route('shop', ['sort' => 'price_high']) }}" class="price-preset-link {{ request('sort') == 'price_high' ? 'active' : '' }}">
                                <span>Bridal & Heavy Zari Sarees</span>
                                <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Kathirazhagi Privilege VIP Concierge Card --}}
                    <div class="sidebar-concierge-card mb-4" data-tilt="true">
                        <div class="concierge-ambient-orb"></div>
                        <div class="position-relative z-2">
                            <span class="concierge-eyebrow">
                                <i class="bi bi-stars text-gold me-1"></i> ATELIER PRIVILEGE
                            </span>
                            <h5 class="concierge-title mt-2 mb-2">Bespoke Styling & Blouse Customization</h5>
                            <p class="concierge-desc mb-3">
                                Connect with our senior South Indian saree stylist for personalized drape consulting and express blouse tailoring.
                            </p>
                            <a href="https://wa.me/919944747683?text={{ urlencode('Hello Kathirazhagi Atelier, I am browsing your shop catalogue and would like styling advice.') }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="btn-concierge-wa magnetic-btn">
                                <i class="bi bi-whatsapp me-2"></i>
                                <span>Chat with Stylist</span>
                            </a>
                        </div>
                    </div>

                    {{-- Handloom Trust Guarantees Widget --}}
                    <div class="sidebar-trust-box">
                        <div class="trust-item d-flex align-items-center gap-3 mb-3">
                            <div class="trust-icon-wrap">
                                <i class="bi bi-award-fill text-gold"></i>
                            </div>
                            <div>
                                <h6 class="trust-title mb-0">Pure Mulberry Silk</h6>
                                <p class="trust-sub mb-0">Genuine Silk Mark certified weaves</p>
                            </div>
                        </div>
                        <div class="trust-item d-flex align-items-center gap-3 mb-3">
                            <div class="trust-icon-wrap">
                                <i class="bi bi-truck text-gold"></i>
                            </div>
                            <div>
                                <h6 class="trust-title mb-0">Secure Transit</h6>
                                <p class="trust-sub mb-0">Double-layered luxury box packing</p>
                            </div>
                        </div>
                        <div class="trust-item d-flex align-items-center gap-3">
                            <div class="trust-icon-wrap">
                                <i class="bi bi-arrow-repeat text-gold"></i>
                            </div>
                            <div>
                                <h6 class="trust-title mb-0">Hassle-Free Returns</h6>
                                <p class="trust-sub mb-0">Easy replacement on unstitched pieces</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            {{-- Right Column: Dynamic Haute Product Grid --}}
            <div class="col-lg-9 col-md-8">

                @if($products->count() > 0)
                <div class="row g-3 g-md-4">
                    @foreach($products as $index => $product)
                    @php
                        $staggerDelay = ($index % 6) * 60;
                        $hasDiscount = $product->sale_price !== null && $product->sale_price < $product->price;
                        $discountPercent = $hasDiscount ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
                        $showDiscountBadge = $hasDiscount && $discountPercent >= 1;
                    @endphp

                    <div class="col-6 col-lg-4" data-motion="fade-up" data-motion-delay="{{ $staggerDelay }}">
                        <div class="luxury-product-card h-100" data-tilt="true">

                            {{-- Media Container --}}
                            <div class="luxury-media-box position-relative overflow-hidden">
                                
                                {{-- Sale / Offer Badge --}}
                                @if($showDiscountBadge)
                                <div class="luxury-offer-badge pulse-ring-glow">
                                    <span class="badge-text">EXTRA {{ $discountPercent }}% OFF</span>
                                </div>
                                @elseif($product->is_featured)
                                <div class="luxury-featured-badge">
                                    <i class="bi bi-stars me-1"></i> ROYAL EDIT
                                </div>
                                @endif

                                {{-- Main Product Image with Zoom Transition --}}
                                <a href="{{ route('product.details', $product->slug) }}" class="d-block w-100 h-100 image-anchor">
                                    <img src="{{ asset($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="luxury-product-img" 
                                         loading="lazy">
                                    <div class="luxury-card-overlay"></div>
                                </a>

                                {{-- Floating Quick Action Heart (Wishlist) --}}
                                <div class="quick-action-wishlist">
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" onsubmit="handleWishlistAction(event, this)">
                                        @csrf
                                        <button type="submit" class="btn-quick-wishlist" title="Add to Wishlist" aria-label="Add to Wishlist">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </form>
                                </div>

                                {{-- Floating Quick View Button --}}
                                <div class="quick-action-view">
                                    <a href="{{ route('product.details', $product->slug) }}" class="btn-quick-view" title="View Silhouette Details" aria-label="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>

                                {{-- Slide-Up Add To Bag Bar on Hover --}}
                                <div class="quick-add-slideup">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-quick-add-bag magnetic-btn">
                                            <i class="bi bi-bag-plus me-1 text-gold"></i>
                                            <span>Add to Bag</span>
                                            <div class="btn-shimmer-sweep"></div>
                                        </button>
                                    </form>
                                </div>

                                {{-- Gold Framing Hairline --}}
                                <div class="luxury-gold-border-frame"></div>
                            </div>

                            {{-- Product Information Details --}}
                            <div class="luxury-product-info">
                                {{-- Category Label --}}
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="product-category-eyebrow">
                                        {{ $product->category->name ?? 'Haute Silhouettes' }}
                                    </span>
                                    @if($product->stock > 0 && $product->stock <= 3)
                                    <span class="stock-warning-chip">
                                        Only {{ $product->stock }} left
                                    </span>
                                    @endif
                                </div>

                                {{-- Product Name / Title --}}
                                <h3 class="product-card-title mb-2">
                                    <a href="{{ route('product.details', $product->slug) }}" class="product-name-link">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                {{-- Product Price & Savings --}}
                                <div class="product-pricing-strip d-flex align-items-baseline flex-wrap gap-2 mt-auto">
                                    <span class="current-price-val">
                                        ₹{{ number_format($product->sale_price ?? $product->price, 2) }}
                                    </span>

                                    @if($showDiscountBadge)
                                    <span class="original-price-val">
                                        ₹{{ number_format($product->price, 2) }}
                                    </span>
                                    <span class="saving-chip-pill">
                                        Save {{ $discountPercent }}%
                                    </span>
                                    @endif
                                </div>

                                {{-- Secondary Add to Bag Button for Touch / Mobile Visibility --}}
                                <div class="d-block d-md-none mt-3">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-mobile-add-bag w-100">
                                            <i class="bi bi-bag-plus me-1"></i> Add to Bag
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Haute Pagination Section --}}
                <div class="shop-haute-pagination mt-5 pt-4 border-top border-gold-light" data-motion="fade-up">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <span class="text-muted small">
                            Displaying <strong>{{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}</strong> 
                            of <strong>{{ $products->total() }}</strong> curated silhouettes
                        </span>
                        <div class="pagination-links-wrap">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>

                @else
                {{-- Luxurious Empty State (No Products Matched) --}}
                <div class="shop-luxurious-empty text-center p-5" data-motion="zoom-in">
                    <div class="empty-crest-wrap mb-4">
                        <div class="empty-crest-icon">
                            <i class="bi bi-gem"></i>
                        </div>
                    </div>
                    <span class="empty-eyebrow text-gold fw-bold letter-spacing-2 small text-uppercase">
                        ✦ ATELIER REPOSITORY ✦
                    </span>
                    <h3 class="empty-title mt-2 mb-3">No Silhouettes Matched Your Filter</h3>
                    <p class="empty-desc mx-auto mb-4">
                        We couldn't locate pieces matching your specific query. Explore our comprehensive archive or reset all active filters to view all available bridal handloom silks and gowns.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('shop') }}" class="btn-royal-gold magnetic-btn">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>
                            <span>View All Silhouettes</span>
                            <div class="btn-shimmer-sweep"></div>
                        </a>
                        <a href="{{ route('home') }}" class="btn-royal-glass magnetic-btn">
                            <i class="bi bi-house me-2 text-gold"></i>
                            <span>Return to Atelier Home</span>
                        </a>
                    </div>
                </div>
                @endif

            </div>
        </div>

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
       1. SHOP LUXURY TOKENS & KEYFRAME ANIMATIONS
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

    [data-motion="fade-up"] {
        transform: translateY(30px);
    }

    [data-motion="fade-down"] {
        transform: translateY(-30px);
    }

    [data-motion="fade-left"] {
        transform: translateX(35px);
    }

    [data-motion="fade-right"] {
        transform: translateX(-35px);
    }

    [data-motion="zoom-in"] {
        transform: scale(0.92);
    }

    /* Active Motion State */
    [data-motion].motion-active {
        opacity: 1 !important;
        transform: translate(0, 0) scale(1) !important;
    }

    /* Gold Gradient Typography */
    .gold-gradient-text {
        background: linear-gradient(135deg, #FFF6D6 0%, #D4AF37 45%, #E5C358 75%, #FBF3CE 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .text-gold {
        color: var(--gold-primary) !important;
    }

    .border-gold-subtle {
        border-color: rgba(212, 175, 55, 0.25) !important;
    }

    .border-gold-light {
        border-color: rgba(212, 175, 55, 0.18) !important;
    }

    .border-white-10 {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    .letter-spacing-1 {
        letter-spacing: 1.2px;
    }

    .letter-spacing-2 {
        letter-spacing: 2px;
    }

    .fs-xs {
        font-size: 0.65rem;
    }

    /* ===================================================
       2. HAUTE EDITORIAL HERO SECTION
    =================================================== */
    .boutique-shop-hero {
        background: radial-gradient(circle at 75% 25%, #4a1c4c 0%, #2e102f 45%, #180819 100%);
        color: #ffffff;
        position: relative;
        padding-top: 25px;
        padding-bottom: 30px;
    }

    .shop-ambient-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        pointer-events: none;
        z-index: 1;
    }

    .glow-gold {
        top: -15%;
        right: 15%;
        width: 440px;
        height: 440px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.22) 0%, transparent 70%);
    }

    .glow-berry {
        bottom: 0;
        left: -8%;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(139, 75, 124, 0.28) 0%, transparent 70%);
    }

    .shop-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(212, 175, 55, 0.08) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
        z-index: 1;
        opacity: 0.55;
    }

    /* Breadcrumbs */
    .shop-luxury-breadcrumb .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.72);
        text-decoration: none;
        font-size: 0.82rem;
        transition: color 0.3s ease;
    }

    .shop-luxury-breadcrumb .breadcrumb-item a:hover {
        color: var(--gold-primary);
    }

    .shop-luxury-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(212, 175, 55, 0.5);
        content: "✦";
        font-size: 0.65rem;
        padding: 0 10px;
    }

    /* Royal Pill Eyebrow */
    .shop-royal-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 50px;
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: var(--gold-light);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .pill-sparkle {
        color: var(--gold-primary);
    }

    .pill-divider {
        color: rgba(212, 175, 55, 0.6);
    }

    .pill-sub {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.7rem;
    }

    .shop-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.2rem, 3.8vw, 3.4rem);
        font-weight: 700;
        line-height: 1.15;
        letter-spacing: -0.5px;
        color: #ffffff;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.35);
    }

    .shop-hero-lead {
        font-size: clamp(0.92rem, 1.15vw, 1.05rem);
        color: rgba(255, 255, 255, 0.84);
        line-height: 1.7;
        max-width: 650px;
    }

    .stat-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(212, 175, 55, 0.25);
        border-radius: 30px;
        padding: 5px 14px;
        font-size: 0.78rem;
        color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
    }

    /* Right Seal Card */
    .shop-hero-seal-card {
        background: radial-gradient(circle at 50% 50%, #3e1540 0%, #240a25 100%);
        border: 1.5px solid rgba(212, 175, 55, 0.45);
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.45), 0 0 25px rgba(212, 175, 55, 0.15);
        transform-style: preserve-3d;
        transition: transform 0.4s var(--ease-luxury), box-shadow 0.4s var(--ease-luxury);
    }

    .seal-inner-frame {
        border: 1px dashed rgba(212, 175, 55, 0.4);
        border-radius: 18px;
        padding: 20px;
        text-align: center;
    }

    .seal-sub {
        font-size: 0.68rem;
        letter-spacing: 2px;
        font-weight: 700;
        color: var(--gold-light);
    }

    .seal-star {
        color: var(--gold-primary);
        font-size: 0.7rem;
    }

    .seal-title {
        font-family: 'Cinzel', serif;
        font-size: 1.35rem;
        font-weight: 700;
        letter-spacing: 3px;
        color: var(--gold-primary);
        margin: 6px 0;
    }

    .seal-divider {
        width: 40px;
        height: 2px;
        background: var(--gold-primary);
        margin: 8px auto 12px;
    }

    .seal-desc {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.82);
        line-height: 1.5;
        margin-bottom: 0;
    }

    .seal-badge-tag {
        font-size: 0.72rem;
        color: var(--gold-light);
        font-weight: 600;
    }

    .seal-explore-link {
        color: #ffffff;
        font-size: 0.74rem;
        font-weight: 700;
        text-decoration: none;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        transition: color 0.3s ease;
    }

    .seal-explore-link:hover {
        color: var(--gold-primary);
    }

    /* Category Pill Carousel */
    .category-pill-track {
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: thin;
        scrollbar-color: rgba(212, 175, 55, 0.4) transparent;
    }

    .category-pill-track::-webkit-scrollbar {
        height: 4px;
    }

    .category-pill-track::-webkit-scrollbar-thumb {
        background: rgba(212, 175, 55, 0.4);
        border-radius: 4px;
    }

    .hero-cat-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 18px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 50px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.4px;
        transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        backdrop-filter: blur(8px);
        flex-shrink: 0;
    }

    .hero-cat-pill .pill-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(212, 175, 55, 0.5);
        transition: all 0.3s ease;
    }

    .hero-cat-pill:hover {
        background: rgba(212, 175, 55, 0.2);
        color: #ffffff;
        border-color: var(--gold-primary);
        transform: translateY(-2px);
    }

    .hero-cat-pill.active {
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        border-color: #F3E5AB;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
    }

    .hero-cat-pill.active .pill-dot {
        background: #2e102f;
    }

    .pill-count {
        font-size: 0.72rem;
        opacity: 0.8;
    }

    /* ===================================================
       3. LUXURY FILTER & SEARCH TOOLBAR
    =================================================== */
    .shop-main-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
    }

    .shop-luxury-toolbar {
        background: #ffffff;
        border: 1.5px solid rgba(212, 175, 55, 0.3);
        border-radius: 20px;
        padding: 20px 24px;
        box-shadow: 0 10px 30px rgba(46, 16, 47, 0.06);
    }

    .luxury-search-wrap {
        display: flex;
        align-items: center;
        background: #FAF8F1;
        border: 1.5px solid rgba(46, 16, 47, 0.12);
        border-radius: 50px;
        padding: 3px 4px 3px 18px;
        transition: all 0.3s ease;
    }

    .luxury-search-wrap:focus-within {
        border-color: var(--gold-primary);
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
    }

    .search-icon {
        font-size: 1rem;
        margin-right: 10px;
    }

    .luxury-search-input {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        font-size: 0.88rem;
        padding: 8px 0;
        color: var(--purple-deep);
    }

    .luxury-search-input::placeholder {
        color: #888;
        font-size: 0.84rem;
    }

    .search-clear-btn {
        color: #999;
        font-size: 1rem;
        margin-right: 10px;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .search-clear-btn:hover {
        color: #c2185b;
    }

    .luxury-search-btn {
        background: linear-gradient(135deg, var(--purple-deep) 0%, #451b47 100%);
        color: var(--gold-light);
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 50px;
        padding: 8px 20px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .luxury-search-btn:hover {
        background: var(--gold-primary);
        color: #2e102f;
        border-color: var(--gold-primary);
    }

    .results-count-chip {
        font-size: 0.82rem;
        color: #666;
        background: #FAF8F1;
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid rgba(46, 16, 47, 0.08);
    }

    .sort-selector-wrap {
        position: relative;
        min-width: 220px;
    }

    .sort-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.85rem;
        pointer-events: none;
        z-index: 2;
    }

    .luxury-sort-select {
        padding-left: 38px;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 50px;
        border: 1.5px solid rgba(46, 16, 47, 0.12);
        background-color: #FAF8F1;
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--purple-deep);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .luxury-sort-select:focus {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        background-color: #ffffff;
    }

    /* Active Filter Chips */
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(46, 16, 47, 0.06);
        border: 1px solid rgba(212, 175, 55, 0.35);
        color: var(--purple-deep);
        border-radius: 30px;
        padding: 4px 12px;
        font-size: 0.78rem;
    }

    .filter-chip-remove {
        color: var(--purple-deep);
        text-decoration: none;
        display: flex;
        align-items: center;
        font-size: 1rem;
        line-height: 1;
        transition: color 0.2s ease;
    }

    .filter-chip-remove:hover {
        color: #c2185b;
    }

    .clear-all-pill {
        color: #c2185b;
        font-size: 0.78rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: opacity 0.2s ease;
    }

    .clear-all-pill:hover {
        opacity: 0.8;
        text-decoration: underline;
    }

    /* ===================================================
       4. HAUTE EDITORIAL SIDEBAR
    =================================================== */
    .shop-editorial-sidebar {
        position: sticky;
        top: 90px;
    }

    .sidebar-box {
        background: #ffffff;
        border: 1px solid rgba(212, 175, 55, 0.25);
        border-radius: 20px;
        padding: 22px;
        box-shadow: 0 8px 24px rgba(46, 16, 47, 0.04);
    }

    .sidebar-box-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.12rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .badge-cat-count {
        background: rgba(212, 175, 55, 0.15);
        color: var(--gold-dark);
        font-size: 0.72rem;
        font-weight: 700;
        border-radius: 20px;
        padding: 3px 8px;
    }

    .luxury-category-menu {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .cat-menu-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 12px;
        border-radius: 12px;
        color: #555555;
        text-decoration: none;
        font-size: 0.86rem;
        font-weight: 500;
        transition: all 0.25s ease;
    }

    .cat-indicator {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #ddd;
        margin-right: 10px;
        transition: all 0.25s ease;
    }

    .cat-badge-num {
        font-size: 0.74rem;
        color: #888;
        background: #f5f2eb;
        padding: 2px 7px;
        border-radius: 20px;
        transition: all 0.25s ease;
    }

    .cat-menu-link:hover {
        background: #FAF8F1;
        color: var(--purple-deep);
        padding-left: 16px;
    }

    .cat-menu-link:hover .cat-indicator {
        background: var(--gold-primary);
        transform: scale(1.4);
    }

    .cat-menu-link.active {
        background: linear-gradient(135deg, rgba(46, 16, 47, 0.08) 0%, rgba(212, 175, 55, 0.12) 100%);
        color: var(--purple-deep);
        font-weight: 700;
        border-left: 3px solid var(--gold-primary);
    }

    .cat-menu-link.active .cat-indicator {
        background: var(--gold-primary);
        box-shadow: 0 0 8px rgba(212, 175, 55, 0.8);
    }

    .cat-menu-link.active .cat-badge-num {
        background: var(--purple-deep);
        color: var(--gold-light);
    }

    /* Price Presets */
    .price-preset-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        border-radius: 10px;
        background: #FAF8F1;
        border: 1px solid rgba(46, 16, 47, 0.06);
        color: #555;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.25s ease;
    }

    .price-preset-link:hover,
    .price-preset-link.active {
        background: var(--purple-deep);
        color: var(--gold-light);
        border-color: var(--purple-deep);
        transform: translateX(4px);
    }

    /* VIP Concierge Box */
    .sidebar-concierge-card {
        background: radial-gradient(circle at 80% 20%, #451b47 0%, #2e102f 65%, #180819 100%);
        border: 1.5px solid rgba(212, 175, 55, 0.4);
        border-radius: 20px;
        padding: 24px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(46, 16, 47, 0.25);
        transform-style: preserve-3d;
        transition: transform 0.4s var(--ease-luxury), box-shadow 0.4s var(--ease-luxury);
    }

    .concierge-ambient-orb {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.3) 0%, transparent 70%);
        pointer-events: none;
    }

    .concierge-eyebrow {
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: var(--gold-primary);
        text-transform: uppercase;
        display: block;
    }

    .concierge-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: #ffffff;
        line-height: 1.3;
    }

    .concierge-desc {
        font-size: 0.78rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.5;
    }

    .btn-concierge-wa {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 9px 16px;
        background: #25D366;
        color: #ffffff;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.35);
        transition: all 0.3s ease;
    }

    .btn-concierge-wa:hover {
        background: #1ebc59;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.45);
    }

    /* Trust Box */
    .sidebar-trust-box {
        background: #FAF8F1;
        border: 1px dashed rgba(212, 175, 55, 0.35);
        border-radius: 18px;
        padding: 18px;
    }

    .trust-icon-wrap {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid rgba(212, 175, 55, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .trust-title {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .trust-sub {
        font-size: 0.72rem;
        color: #777;
    }

    /* ===================================================
       5. ULTRA-PREMIUM PRODUCT CARD (3D TILT & MOTION)
    =================================================== */
    .luxury-product-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(212, 175, 55, 0.22);
        box-shadow: 0 10px 25px rgba(46, 16, 47, 0.06);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transform-style: preserve-3d;
        transition: transform 0.45s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.45s cubic-bezier(0.165, 0.84, 0.44, 1), border-color 0.45s ease;
    }

    .luxury-product-card:hover {
        box-shadow: 0 20px 45px rgba(46, 16, 47, 0.16), 0 0 25px rgba(212, 175, 55, 0.25);
        border-color: rgba(212, 175, 55, 0.7);
    }

    .luxury-media-box {
        position: relative;
        width: 100%;
        aspect-ratio: 3 / 4;
        background: #f7f3ec;
    }

    .image-anchor {
        position: relative;
    }

    .luxury-product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 20%;
        transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        display: block;
    }

    .luxury-product-card:hover .luxury-product-img {
        transform: scale(1.08);
    }

    .luxury-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.02) 0%, rgba(46, 16, 47, 0.15) 60%, rgba(46, 16, 47, 0.7) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }

    .luxury-product-card:hover .luxury-card-overlay {
        opacity: 1;
    }

    .luxury-gold-border-frame {
        position: absolute;
        inset: 8px;
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 14px;
        pointer-events: none;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .luxury-product-card:hover .luxury-gold-border-frame {
        opacity: 1;
        inset: 6px;
    }

    /* Badges */
    .luxury-offer-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, #c2185b, #880e4f);
        color: #ffffff;
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.8px;
        padding: 5px 12px;
        border-radius: 30px;
        z-index: 3;
        box-shadow: 0 4px 12px rgba(194, 24, 91, 0.35);
    }

    .luxury-featured-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, #2e102f, #1b071c);
        color: var(--gold-primary);
        border: 1px solid rgba(212, 175, 55, 0.4);
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 5px 12px;
        border-radius: 30px;
        z-index: 3;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    /* Floating Quick Actions */
    .quick-action-wishlist {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 3;
    }

    .btn-quick-wishlist {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.35);
        color: var(--purple-deep);
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .btn-quick-wishlist:hover {
        background: var(--purple-deep);
        color: #ff3366;
        border-color: var(--purple-deep);
        transform: scale(1.12);
    }

    .btn-quick-wishlist.wishlist-saved {
        background: #fff;
        color: #ff3366;
        border-color: #ff3366;
    }

    .quick-action-view {
        position: absolute;
        top: 54px;
        right: 12px;
        z-index: 3;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.3s ease;
    }

    .luxury-product-card:hover .quick-action-view {
        opacity: 1;
        transform: translateX(0);
    }

    .btn-quick-view {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.35);
        color: var(--purple-deep);
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        transition: all 0.25s ease;
    }

    .btn-quick-view:hover {
        background: var(--purple-deep);
        color: var(--gold-light);
        border-color: var(--purple-deep);
        transform: scale(1.12);
    }

    /* Slide-Up Add To Bag Bar */
    .quick-add-slideup {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 12px 14px;
        background: linear-gradient(180deg, transparent 0%, rgba(31, 11, 32, 0.88) 100%);
        transform: translateY(100%);
        transition: transform 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
        z-index: 3;
    }

    .luxury-product-card:hover .quick-add-slideup {
        transform: translateY(0);
    }

    .btn-quick-add-bag {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 8px 14px;
        border-radius: 30px;
        border: 1px solid #F3E5AB;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
        position: relative;
        overflow: hidden;
        transition: all 0.25s ease;
    }

    .btn-quick-add-bag:hover {
        background: #ffffff;
        color: #2e102f;
        transform: scale(1.02);
    }

    /* Product Info Details */
    .luxury-product-info {
        padding: 16px 14px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-category-eyebrow {
        font-size: 0.68rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        color: var(--gold-dark);
    }

    .stock-warning-chip {
        font-size: 0.64rem;
        color: #c2185b;
        font-weight: 700;
        background: #fce4ec;
        padding: 2px 6px;
        border-radius: 10px;
    }

    .product-card-title {
        font-size: 0.94rem;
        font-weight: 600;
        line-height: 1.35;
        margin: 0;
    }

    .product-name-link {
        color: var(--purple-deep);
        text-decoration: none;
        transition: color 0.25s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-name-link:hover {
        color: var(--purple-accent);
    }

    .product-pricing-strip {
        padding-top: 6px;
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
        font-weight: 500;
    }

    .saving-chip-pill {
        font-size: 0.7rem;
        color: #c2185b;
        font-weight: 700;
        background: #fce4ec;
        padding: 2px 7px;
        border-radius: 12px;
    }

    .btn-mobile-add-bag {
        background: var(--purple-deep);
        color: var(--gold-light);
        border: 1px solid rgba(212, 175, 55, 0.3);
        border-radius: 25px;
        padding: 8px 12px;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* ===================================================
       6. HAUTE PAGINATION STYLING
    =================================================== */
    .shop-haute-pagination .pagination {
        margin-bottom: 0;
        gap: 6px;
    }

    .shop-haute-pagination .page-item .page-link {
        background: #ffffff;
        border: 1.5px solid rgba(212, 175, 55, 0.35);
        color: var(--purple-deep);
        font-size: 0.86rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 30px !important;
        transition: all 0.25s ease;
    }

    .shop-haute-pagination .page-item.active .page-link {
        background: var(--purple-deep);
        color: var(--gold-light);
        border-color: var(--gold-primary);
        box-shadow: 0 4px 15px rgba(46, 16, 47, 0.25);
    }

    .shop-haute-pagination .page-item .page-link:hover {
        background: var(--gold-primary);
        color: #2e102f;
        border-color: var(--gold-primary);
        transform: translateY(-2px);
    }

    /* ===================================================
       7. EMPTY STATE
    =================================================== */
    .shop-luxurious-empty {
        background: #ffffff;
        border: 1.5px dashed rgba(212, 175, 55, 0.4);
        border-radius: 28px;
        box-shadow: 0 15px 40px rgba(46, 16, 47, 0.05);
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
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.25);
    }

    .empty-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--purple-deep);
    }

    .empty-desc {
        font-size: 0.95rem;
        color: #666;
        max-width: 540px;
        line-height: 1.6;
    }

    /* Buttons */
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
        transition: all 0.35s var(--ease-luxury);
        text-decoration: none;
    }

    .btn-royal-gold:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 14px 30px rgba(212, 175, 55, 0.55);
        color: #1a081b;
    }

    .btn-royal-glass {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 26px;
        border-radius: 50px;
        background: rgba(46, 16, 47, 0.05);
        color: var(--purple-deep);
        font-weight: 600;
        font-size: 0.84rem;
        letter-spacing: 0.5px;
        border: 1.5px solid rgba(212, 175, 55, 0.45);
        transition: all 0.35s var(--ease-luxury);
        text-decoration: none;
    }

    .btn-royal-glass:hover {
        background: var(--purple-deep);
        color: #ffffff;
        border-color: var(--purple-deep);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(46, 16, 47, 0.2);
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

    /* Pulse Glow */
    .pulse-ring-glow {
        position: relative;
    }

    .pulse-ring-glow::after {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: inherit;
        border: 1.5px solid #c2185b;
        animation: pulseRingAura 2.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) infinite;
        pointer-events: none;
    }

    @keyframes pulseRingAura {
        0% { transform: scale(0.95); opacity: 0.9; }
        70% { transform: scale(1.15); opacity: 0; }
        100% { transform: scale(1.15); opacity: 0; }
    }

    /* ===================================================
       8. INFINITE LUXURY MARQUEE RIBBON
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

    /* ===================================================
       9. RESPONSIVE BREAKPOINTS
    =================================================== */
    @media (max-width: 991px) {
        .shop-editorial-sidebar {
            position: static;
            margin-bottom: 30px;
        }

        .shop-hero-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 575px) {
        .luxury-product-info {
            padding: 10px 8px;
        }

        .product-card-title {
            font-size: 0.82rem;
        }

        .current-price-val {
            font-size: 0.92rem;
        }

        .luxury-offer-badge,
        .luxury-featured-badge {
            font-size: 0.6rem;
            padding: 3px 8px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // ===================================================
    // 1. INTERSECTION OBSERVER SCROLL-REVEAL ENGINE
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
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -30px 0px'
        });

        motionElements.forEach(el => motionObserver.observe(el));
    } else {
        // Fallback for older browsers
        motionElements.forEach(el => el.classList.add('motion-active'));
    }

    // ===================================================
    // 2. INTERACTIVE 3D PERSPECTIVE TILT FOR PRODUCT CARDS
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

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const deltaX = (x - centerX) / centerX;
            const deltaY = (y - centerY) / centerY;

            // Maximum tilt angle
            const maxTilt = 7;
            const rotateX = -deltaY * maxTilt;
            const rotateY = deltaX * maxTilt;

            card.style.transform = `perspective(800px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) translateY(-6px)`;
        });

        card.addEventListener('mouseleave', () => {
            isHovered = false;
            card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
            card.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });
    });

    // ===================================================
    // 3. MAGNETIC BUTTON INTERACTION
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
});

// Wishlist Action with Instant Heart Micro-Burst
function handleWishlistAction(e, form) {
    const btn = form.querySelector('.btn-quick-wishlist');
    if (btn) {
        btn.classList.add('wishlist-saved');
        btn.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>';
    }
}
</script>
@endpush
