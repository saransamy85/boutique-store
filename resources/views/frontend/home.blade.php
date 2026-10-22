@extends('frontend.layouts.app')

@php
// ---- Brand Meta & Variables ----
$brand = 'Kathirazhagi Boutique';
$brandShort = 'Kathirazhagi';
$joinUrl = Route::has('register') ? route('register') : route('shop');

// Curated Signature Editorial Collections
$collections = [
    [
        'id' => 'festive-silk',
        'badge' => "Stylist's Royal Edit",
        'tag' => 'Heritage Silk & Kanjeevarams',
        'title' => 'The Royal Festive Edit',
        'desc' => 'Opulent pure mulberry silk weaves, ornate antique golden zari borders, and majestic peacock pallus handcrafted for weddings and temple celebrations.',
        'cta' => 'Explore Festive Edit',
        'url' => route('shop', ['category' => 'kanchi-cotton']),
        'image' => asset('frontend/images/curated-festive-silk.jpg'),
        'price_from' => 'From ₹999',
        'tags' => ['Pure Zari Weaves', 'Handloom Certified', 'Temple Motifs'],
        'featured' => true,
    ],
    [
        'id' => 'chanderi-grace',
        'badge' => 'Bestseller Edit',
        'tag' => 'Breathable Luxury',
        'title' => 'Chanderi & Cotton Grace',
        'desc' => 'Featherlight airy weaves and delicate floral hand-embroideries designed for effortless day-to-evening allure.',
        'cta' => 'Shop Chanderi Edit',
        'url' => route('shop', ['category' => 'chanderi']),
        'image' => asset('frontend/images/curated-chanderi-grace.jpg'),
        'price_from' => 'From ₹799',
        'tags' => ['Lightweight Sheer', 'Pastel Tones'],
        'featured' => false,
    ],
    [
        'id' => 'evening-gowns',
        'badge' => 'Evening Couture',
        'tag' => 'Contemporary Silhouettes',
        'title' => 'Regal Twilight Gowns',
        'desc' => 'Voluminous flared hemlines, rich deep jewel tones, and shimmering sequin embellishments for celebrated evenings.',
        'cta' => 'Discover Gowns Edit',
        'url' => route('shop', ['category' => 'spacesilk-gown']),
        'image' => asset('frontend/images/curated-fusion-gowns.jpg'),
        'price_from' => 'From ₹1,299',
        'tags' => ['Statement Flairs', 'Hand Sequinned'],
        'featured' => false,
    ],
];

// Verified Patron Feedback & Stories
$reviews = [
    [
        'name' => 'Ankita Rao',
        'city' => 'Bengaluru',
        'date' => '30/06/26',
        'img' => 'feedback1.jpg',
        'product' => 'Kanchi Silk Saree',
        'rating' => 5,
        'title' => 'Beyond Expectation!',
        'text' => 'I bought a Kanchi saree for my sister\'s engagement and I couldn\'t be happier. The zari work is exquisite and the silk feels so pure and regal. It arrived in gorgeous boutique packaging with great care.'
    ],
    [
        'name' => 'Nisha Patel',
        'city' => 'Mumbai',
        'date' => '30/06/26',
        'img' => 'feedback2.jpg',
        'product' => 'Chanderi Ethnic Suit',
        'rating' => 5,
        'title' => 'Dreamy Draping & Comfort',
        'text' => 'My experience has been fantastic. The fabric is breathable and drapes effortlessly throughout long festive days. I received countless compliments on the delicate color harmony.'
    ],
    [
        'name' => 'Meera Das',
        'city' => 'Chennai',
        'date' => '29/06/26',
        'img' => 'feedback3.jpg',
        'product' => 'Spacesilk Designer Gown',
        'rating' => 5,
        'title' => 'Stunning Party Look',
        'text' => 'The flair and structure of the Spacesilk gown are spectacular! Fits like a dream without needing any alterations. Fast shipping and truly premium customer support.'
    ],
    [
        'name' => 'Dr. Priyadarshini K.',
        'city' => 'Coimbatore',
        'date' => '04/07/26',
        'img' => 'feedback4.jpg',
        'product' => 'Peach Floral Chanderi Edit',
        'rating' => 5,
        'title' => 'Pure Elegance & Quality',
        'text' => 'Kathirazhagi never disappoints! The soft peach tone and handcrafted embroidery on the chanderi dress are so subtle yet rich. It has quickly become my go-to celebratory outfit.'
    ],
    [
        'name' => 'Revathi Sundaram',
        'city' => 'Madurai',
        'date' => '12/07/26',
        'img' => 'feedback5.jpg',
        'product' => 'Traditional Yellow Temple Saree',
        'rating' => 5,
        'title' => 'Authentic Heritage Weave',
        'text' => 'Wore this traditional yellow saree for a family wedding puja. The golden border gleams so naturally under ceremonial lights. Authentic South Indian handloom feel at an honest price.'
    ],
    [
        'name' => 'Kavya Subramanian',
        'city' => 'Hyderabad',
        'date' => '18/07/26',
        'img' => 'feedback6.jpg',
        'product' => 'Regal Wine Flared Gown',
        'rating' => 5,
        'title' => 'Showstopper at Reception',
        'text' => 'The deep wine hue and fine sequin craftsmanship made me feel like royalty at my cousin\'s reception! The fabric moves so gracefully and feels featherlight on skin.'
    ],
];
@endphp

@section('title', $brand . ' | Haute Couture & Handloom Silhouettes')
@section('meta_description', 'Discover timeless handloom sarees, designer ethnic gowns, new arrivals and bridal silhouettes at ' . $brand . '.')

@section('content')

{{-- ===================================================
    1. ULTRA-PREMIUM EDITORIAL HERO BANNER
=================================================== --}}
<section class="boutique-hero-luxury position-relative overflow-hidden" id="heroSection">
    {{-- Ambient Radiant Glow Layers --}}
    <div class="hero-ambient-glow glow-1"></div>
    <div class="hero-ambient-glow glow-2"></div>
    <div class="hero-grid-pattern"></div>

    <div class="container position-relative z-2">
        <div class="row align-items-center min-vh-hero g-5 py-5">
            {{-- Left Column: Haute Typography & Motion Elements --}}
            <div class="col-lg-7" data-motion="fade-right" data-motion-duration="1000">
                {{-- Royal Haute Couture Floating Eyebrow Badge --}}
                <div class="hero-royal-pill mb-3" data-motion="fade-down" data-motion-delay="100">
                    <span class="pill-sparkle"><i class="bi bi-stars"></i></span>
                    <span class="pill-text">AUTUMN FESTIVE COUTURE 2026</span>
                    <span class="pill-divider">•</span>
                    <span class="pill-sub">PURE ZARI & SILK</span>
                </div>

                {{-- Majestic Editorial Headline --}}
                <h1 class="hero-editorial-title mb-3" data-motion="fade-up" data-motion-delay="200">
                    Effortless Elegance. <br>
                    <span class="gold-gradient-text">Timeless Silhouettes.</span>
                </h1>

                {{-- Editorial Description --}}
                <p class="hero-editorial-lead mb-4" data-motion="fade-up" data-motion-delay="300">
                    Step into an exquisite world of handloom heirlooms, ornate golden zari borders, and modern celebratory gowns woven for women who carry tradition with contemporary grace.
                </p>

                {{-- Magnetic Interactive CTAs --}}
                <div class="d-flex flex-wrap align-items-center gap-3 mb-5" data-motion="fade-up" data-motion-delay="400">
                    <a href="{{ route('shop', ['sort' => 'latest']) }}" class="btn-royal-gold magnetic-btn">
                        <span>Explore New Arrivals</span>
                        <i class="bi bi-arrow-right-short fs-4 ms-1"></i>
                        <div class="btn-shimmer-sweep"></div>
                    </a>
                    <a href="{{ route('shop', ['category' => 'kanchi-cotton']) }}" class="btn-royal-glass magnetic-btn">
                        <i class="bi bi-gem me-2 text-gold"></i>
                        <span>Heritage Sarees Edit</span>
                    </a>
                </div>

                {{-- Trust & Patron Social Proof Pill --}}
                <div class="hero-patron-proof d-flex align-items-center gap-3" data-motion="fade-up" data-motion-delay="500">
                    <div class="patron-avatar-group">
                        <img src="{{ asset('frontend/images/feedback1.jpg') }}" alt="Patron" class="patron-mini-avatar" loading="lazy">
                        <img src="{{ asset('frontend/images/feedback2.jpg') }}" alt="Patron" class="patron-mini-avatar" loading="lazy">
                        <img src="{{ asset('frontend/images/feedback3.jpg') }}" alt="Patron" class="patron-mini-avatar" loading="lazy">
                        <span class="patron-count-badge">5k+</span>
                    </div>
                    <div class="patron-proof-text">
                        <div class="stars-gold">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <span class="text-white fw-bold ms-1">4.9 / 5</span>
                        </div>
                        <span class="proof-sub">Cherished by 5,000+ Patrons across India & UK</span>
                    </div>
                </div>
            </div>

            {{-- Right Column: Interactive 3D Showcase Card & Floating Royal Insignia --}}
            <div class="col-lg-5 text-center position-relative" data-motion="fade-left" data-motion-delay="250">
                <div class="hero-showcase-container">
                    {{-- Floating Rotating Monogram Seal --}}
                    <div class="hero-rotating-seal" title="Kathirazhagi Handloom Heritage">
                        <svg viewBox="0 0 160 160" class="seal-svg-ring">
                            <path id="sealCurve" d="M 80, 80 m -60, 0 a 60,60 0 1,1 120,0 a 60,60 0 1,1 -120,0" fill="transparent" />
                            <text class="seal-svg-text">
                                <textPath href="#sealCurve" startOffset="0%">
                                    • KATHIRAZHAGI ATELIER • CHENNAI • UK • ESTD 2018
                                </textPath>
                            </text>
                        </svg>
                        <div class="seal-center-crest">
                            <i class="bi bi-crown-fill text-gold"></i>
                        </div>
                    </div>

                    {{-- Main Floating Card with 3D Tilt --}}
                    <div class="hero-couture-card float-motion" data-tilt="true">
                        <div class="hero-card-inner">
                            <img src="{{ asset('frontend/images/hero-couture-showcase.jpg') }}" alt="Royal Festive Silhouette" class="hero-card-img" loading="eager">
                            <div class="hero-card-overlay"></div>
                            <div class="hero-card-gold-border"></div>

                            {{-- Floating Hotspot Lookbook Tag --}}
                            <div class="hero-hotspot-tag pulse-ring-glow">
                                <span class="hotspot-dot"></span>
                                <span class="hotspot-label">Pure Zari Brocade • Handloom</span>
                            </div>

                            {{-- Bottom Card Meta --}}
                            <div class="hero-card-meta text-start">
                                <span class="hero-card-tag">Signature Bridal Edit</span>
                                <h4 class="hero-card-title">Kanchipuram Royal Silk</h4>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="hero-card-price">From ₹999</span>
                                    <span class="hero-card-link">
                                        View Silhouette <i class="bi bi-arrow-right ms-1"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Mini Floating Feature Chip --}}
                    <div class="floating-chip-silk">
                        <div class="chip-icon"><i class="bi bi-patch-check-fill text-gold"></i></div>
                        <div>
                            <span class="chip-title">100% Handloom Certified</span>
                            <span class="chip-sub">Direct From Master Weavers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scroll to Explore Prompter --}}
        <div class="hero-scroll-prompter text-center" data-motion="fade-up" data-motion-delay="600">
            <a href="#luxuryMarquee" class="scroll-down-link" aria-label="Scroll to discover collection">
                <span class="scroll-mouse">
                    <span class="scroll-wheel"></span>
                </span>
                <span class="scroll-text">DISCOVER THE EDIT</span>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================
    2. INFINITE RUNWAY MARQUEE RIBBON (GOLDEN GLAMOUR)
=================================================== --}}
<section class="luxury-marquee-section" id="luxuryMarquee">
    <div class="marquee-track">
        <div class="marquee-content">
            <span class="marquee-item"><i class="bi bi-star-fill text-gold"></i> PURE SILK & KANCHI HANDLOOMS</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-stars text-gold"></i> THE ROYAL FESTIVE EDIT 2026</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-airplane-fill text-gold"></i> EXPRESS WORLDWIDE DELIVERY</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-gem text-gold"></i> 5,000+ DISCERNING PATRONS</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-patch-check-fill text-gold"></i> ARTISANAL WEAVES FROM MASTER CRAFTSMEN</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-box2-heart-fill text-gold"></i> COMPLIMENTARY BESPOKE GIFT PACKAGING</span>
            <span class="marquee-item">•</span>
        </div>
        <div class="marquee-content" aria-hidden="true">
            <span class="marquee-item"><i class="bi bi-star-fill text-gold"></i> PURE SILK & KANCHI HANDLOOMS</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-stars text-gold"></i> THE ROYAL FESTIVE EDIT 2026</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-airplane-fill text-gold"></i> EXPRESS WORLDWIDE DELIVERY</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-gem text-gold"></i> 5,000+ DISCERNING PATRONS</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-patch-check-fill text-gold"></i> ARTISANAL WEAVES FROM MASTER CRAFTSMEN</span>
            <span class="marquee-item">•</span>
            <span class="marquee-item"><i class="bi bi-box2-heart-fill text-gold"></i> COMPLIMENTARY BESPOKE GIFT PACKAGING</span>
            <span class="marquee-item">•</span>
        </div>
    </div>
</section>

{{-- ===================================================
    3. SHOP BY CATEGORY (HAUTE GRID & 3D INTERACTIVE TILT)
=================================================== --}}
<section class="boutique-categories-section py-5 position-relative" id="categoriesSection">
    <div class="container position-relative z-1">
        {{-- Luxury Section Header --}}
        <div class="row align-items-end mb-4 mb-lg-5 g-3">
            <div class="col-lg-8" data-motion="fade-right">
                <div class="cat-eyebrow-badge mb-2">
                    <i class="bi bi-stars"></i>
                    <span>SIGNATURE SILHOUETTES</span>
                </div>
                <h2 class="cat-main-title mb-2">Shop by Category</h2>
                <p class="cat-sub-title mb-0">Immerse in curated South Indian handloom weaves, celebratory lehengas, and graceful evening ensembles.</p>
            </div>
            <div class="col-lg-4 text-lg-end" data-motion="fade-left">
                <a href="{{ route('shop') }}" class="btn-cat-view-all magnetic-btn">
                    <span>Explore Full Boutique</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Categories Showcase Grid with Staggered Scroll & 3D Tilt --}}
        <div class="boutique-cat-grid">
            @forelse($categories as $index => $category)
            <div class="boutique-cat-card-wrapper" data-motion="fade-up" data-motion-delay="{{ ($index % 5) * 80 }}">
                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="boutique-cat-card" data-tilt="true" title="Shop {{ $category->name }}">
                    {{-- Media Card --}}
                    <div class="cat-media">
                        @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="cat-img" loading="lazy">
                        @else
                        <div class="cat-placeholder d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-gem fs-2 text-warning opacity-75 mb-1"></i>
                            <span class="small text-muted">Boutique Edit</span>
                        </div>
                        @endif

                        {{-- Rich Gradient Overlay for contrast --}}
                        <div class="cat-overlay"></div>

                        {{-- Item Count Chip --}}
                        <div class="cat-chip-badge">
                            <span class="cat-chip-icon"><i class="bi bi-bag"></i></span>
                            <span class="cat-chip-text">{{ $category->products_count ?? 0 }} {{ Str::plural('Style', $category->products_count ?? 0) }}</span>
                        </div>

                        {{-- Decorative Gold Inner Frame --}}
                        <div class="cat-accent-frame"></div>

                        {{-- Category Meta & CTA --}}
                        <div class="cat-content">
                            @if(!empty($category->description))
                            <span class="cat-desc-tag">{{ Str::limit($category->description, 26) }}</span>
                            @endif
                            <h3 class="cat-name">{{ $category->name }}</h3>

                            <div class="cat-cta-bar">
                                <span class="cat-cta-text">Explore Edit</span>
                                <span class="cat-cta-circle">
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No categories available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===================================================
    4. THE ART OF KATHIRAZHAGI (ARTISANAL HERITAGE STORY)
=================================================== --}}
<section class="heritage-story-section py-5 position-relative overflow-hidden" id="heritageStory">
    <div class="heritage-ambient-pattern"></div>
    <div class="container position-relative z-2">
        <div class="row align-items-center g-5 py-4">
            {{-- Left Side: Artisanal Handloom Visual Composition --}}
            <div class="col-lg-6" data-motion="fade-right">
                <div class="heritage-image-frame-wrap position-relative">
                    {{-- Primary Gold-Framed Image --}}
                    <div class="heritage-img-main">
                        <img src="{{ asset('frontend/images/artisan-heritage.jpg') }}" alt="Artisanal Pure Zari Peacock Weave" class="img-fluid rounded-4 shadow-2xl" loading="lazy">
                        <div class="heritage-gold-overlay"></div>
                    </div>

                    {{-- Floating Royal Guarantee Seal --}}
                    <div class="heritage-floating-seal float-motion" data-motion="zoom-in" data-motion-delay="200">
                        <div class="seal-inner">
                            <i class="bi bi-patch-check-fill text-gold fs-3 mb-1"></i>
                            <span class="seal-title">MASTER WEAVE</span>
                            <span class="seal-subtitle">100% Pure Silk</span>
                        </div>
                    </div>

                    {{-- Accent Gold Filigree Border Box --}}
                    <div class="heritage-accent-box"></div>
                </div>
            </div>

            {{-- Right Side: The Story & Live Numerical Counters --}}
            <div class="col-lg-6" data-motion="fade-left">
                <div class="cat-eyebrow-badge badge-on-dark mb-2">
                    <i class="bi bi-flower1"></i>
                    <span>HANDLOOM HERITAGE SINCE 2018</span>
                </div>
                <h2 class="heritage-title mb-3">
                    Woven with Soul.<br>
                    <span class="gold-gradient-text">Tailored for Royalty.</span>
                </h2>
                <p class="heritage-text mb-4">
                    Every weave at Kathirazhagi is an ode to centuries of South Indian handloom mastery. From the rhythmic clatter of traditional wooden pit looms in Tamil Nadu to intricate gold zari motifs inspired by Dravidian temple architecture, each creation embodies grace, heritage, and uncompromising authenticity.
                </p>

                {{-- Live Interactive Animated Counters --}}
                <div class="row g-3 g-sm-4 heritage-counter-grid mb-4">
                    <div class="col-6 col-sm-3">
                        <div class="counter-box" data-motion="fade-up" data-motion-delay="100">
                            <h3 class="counter-num" data-target="5000">0</h3>
                            <span class="counter-plus">+</span>
                            <p class="counter-label">Cherished Patrons</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="counter-box" data-motion="fade-up" data-motion-delay="200">
                            <h3 class="counter-num" data-target="100">0</h3>
                            <span class="counter-plus">%</span>
                            <p class="counter-label">Authentic Handloom</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="counter-box" data-motion="fade-up" data-motion-delay="300">
                            <h3 class="counter-num" data-target="25">0</h3>
                            <span class="counter-plus">+</span>
                            <p class="counter-label">Master Weavers</p>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="counter-box" data-motion="fade-up" data-motion-delay="400">
                            <h3 class="counter-num" data-target="4.9" data-decimal="true">0</h3>
                            <span class="counter-plus">★</span>
                            <p class="counter-label">Patron Rating</p>
                        </div>
                    </div>
                </div>

                {{-- Read Story CTA --}}
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('shop') }}" class="btn-royal-gold magnetic-btn">
                        <span>Shop Heritage Weaves</span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <span class="text-white-50 small d-none d-sm-inline-block">Certified Handloom Mark</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    5. NEW ARRIVALS & TRENDING SPOTLIGHT (INTERACTIVE TABS)
=================================================== --}}
<section class="luna-new-arrivals py-5 position-relative" id="arrivalsSection">
    <div class="container position-relative z-1">
        {{-- Section Header with Interactive Filter Tabs --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-lg-5" data-motion="fade-up">
            <div>
                <div class="cat-eyebrow-badge mb-2">
                    <i class="bi bi-sparkles"></i>
                    <span>RUNWAY HIGHLIGHTS</span>
                </div>
                <h2 class="curated-section-heading mb-1">Curated New Arrivals</h2>
                <p class="curated-section-sub mb-0">Discover our latest festive drops, handcrafted sarees, and contemporary celebratory silhouettes.</p>
            </div>

            {{-- Interactive Spotlight Tabs --}}
            <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
                <div class="product-filter-tabs d-inline-flex p-1 rounded-pill" role="tablist">
                    <button type="button" class="prod-tab-pill active" data-tab-target="all">
                        <span>All Styles</span>
                    </button>
                    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                    <button type="button" class="prod-tab-pill" data-tab-target="featured">
                        <i class="bi bi-star-fill text-gold me-1"></i>
                        <span>Featured</span>
                    </button>
                    @endif
                    <button type="button" class="prod-tab-pill" data-tab-target="new">
                        <span>Latest Drops</span>
                    </button>
                </div>
                <a href="{{ route('shop', ['sort' => 'latest']) }}" class="btn-cat-view-all d-none d-lg-inline-flex ms-2">
                    <span>Shop All</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Products Grid --}}
        @php
            // Combined collection for rich filtering
            $displayProducts = $newArrivals->take(10);
            if(isset($featuredProducts) && $featuredProducts->count() > 0) {
                $displayProducts = $displayProducts->merge($featuredProducts)->unique('id')->take(10);
            }
        @endphp

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 g-lg-4" id="productsCatalogGrid">
            @forelse($displayProducts as $index => $product)
            @php
                $onSale = $product->sale_price !== null && $product->sale_price < $product->price;
                $discount = $onSale ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
                $isFeatured = (bool) ($product->is_featured ?? false);
                $filterClass = 'tab-item-all ' . ($isFeatured ? 'tab-item-featured ' : '') . 'tab-item-new';
            @endphp

            <div class="col product-item-col {{ $filterClass }}" data-motion="fade-up" data-motion-delay="{{ ($index % 5) * 80 }}">
                <div class="luna-product-card luxury-product-card" data-tilt="true">
                    {{-- Product Image with Hover Action Bar --}}
                    <div class="luna-product-img-wrap position-relative overflow-hidden">
                        {{-- Luxury Status Badges --}}
                        @if($onSale)
                        <span class="offer-badge-red pulse-badge">Extra {{ $discount }}% OFF</span>
                        @elseif($isFeatured)
                        <span class="badge-royal-edit"><i class="bi bi-crown-fill me-1"></i> Royal Edit</span>
                        @else
                        <span class="luna-product-badge">New Arrival</span>
                        @endif

                        <a href="{{ route('product.details', $product->slug) }}" class="d-block product-main-link" aria-label="View {{ $product->name }}">
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="luna-product-img" loading="lazy">
                            @else
                            <div class="luna-product-img d-flex align-items-center justify-content-center bg-light">
                                <i class="bi bi-image fs-1 text-secondary opacity-50"></i>
                            </div>
                            @endif
                        </a>

                        {{-- Floating Quick Action Icons (Hover Reveal) --}}
                        <div class="product-quick-actions">
                            {{-- Wishlist Toggle Button --}}
                            @if(Route::has('wishlist.add'))
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline wishlist-form" onsubmit="handleWishlistAction(event, this)">
                                @csrf
                                <button type="submit" class="quick-action-btn btn-wishlist" title="Add to Wishlist" aria-label="Save to Wishlist">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </form>
                            @endif

                            {{-- Direct Product Details Quick Link --}}
                            <a href="{{ route('product.details', $product->slug) }}" class="quick-action-btn btn-quick-view" title="Quick View" aria-label="View details">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>

                        {{-- Quick Add Overlay Bar on Card Bottom --}}
                        <div class="quick-add-slideup">
                            <a href="{{ route('product.details', $product->slug) }}" class="btn-quick-add">
                                <i class="bi bi-bag-plus me-1"></i> Select Options
                            </a>
                        </div>
                    </div>

                    {{-- Product Information --}}
                    <div class="luna-product-info">
                        @if($product->category)
                        <span class="product-cat-label">{{ $product->category->name }}</span>
                        @endif

                        <a href="{{ route('product.details', $product->slug) }}" class="luna-product-name d-block" title="{{ $product->name }}">
                            {{ Str::limit($product->name, 36) }}
                        </a>

                        <div class="luna-product-price">
                            <span class="current-price">₹{{ number_format((float) ($product->sale_price ?? $product->price), 2) }}</span>
                            @if($onSale)
                            <span class="luna-product-old-price">₹{{ number_format((float) $product->price, 2) }}</span>
                            <span class="discount-text-red">-{{ $discount }}%</span>
                            @endif
                        </div>

                        {{-- Color Palette Dots --}}
                        <div class="luna-product-colors mt-2">
                            <span class="luna-color-dot active" style="background:#8b4b7c" title="Royal Berry"></span>
                            <span class="luna-color-dot" style="background:#d4af37" title="Antique Gold"></span>
                            <span class="luna-color-dot" style="background:#2e102f" title="Deep Aubergine"></span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">New arrivals will be available soon.</p>
                <a href="{{ route('shop') }}" class="btn-royal-gold">Explore Shop</a>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-4 d-md-none">
            <a href="{{ route('shop', ['sort' => 'latest']) }}" class="btn-royal-gold magnetic-btn w-100">
                <span>Shop All New Arrivals</span>
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================
    6. CURATED SIGNATURE COLLECTIONS (EDITORIAL SPLIT)
=================================================== --}}
<section class="curated-section py-5 position-relative" id="curated-collections">
    <div class="container position-relative z-1">
        {{-- Section Header with Interactive Filter Pills --}}
        <div class="d-flex flex-column align-items-center text-center mb-4 mb-lg-5" data-motion="fade-up">
            <div class="cat-eyebrow-badge mb-2">
                <i class="bi bi-stars"></i>
                <span>EXCLUSIVE EDITORIAL EDITS</span>
            </div>
            <h2 class="curated-section-heading mb-2">Curated Collections</h2>
            <p class="curated-section-sub mb-4">
                Immerse yourself in handpicked artisanal weaves, festive opulence, and modern silhouette stories crafted for life's celebrated moments.
            </p>

            {{-- Interactive Category/Story Pills --}}
            <div class="curated-tabs-wrapper d-flex flex-wrap gap-2 justify-content-center" role="tablist">
                <button type="button" class="curated-filter-pill active" data-curated-filter="all">
                    <i class="bi bi-grid-fill me-1"></i> All Edits
                </button>
                @foreach($collections as $col)
                <button type="button" class="curated-filter-pill" data-curated-filter="{{ $col['id'] }}">
                    <span>{{ $col['title'] }}</span>
                </button>
                @endforeach
            </div>
        </div>

        {{-- Asymmetrical High-Fashion Showcase Grid --}}
        @php
            $featuredCol = collect($collections)->firstWhere('featured', true) ?? $collections[0];
            $otherCols = collect($collections)->reject(fn($c) => $c['id'] === $featuredCol['id'])->values();
        @endphp

        <div class="curated-editorial-grid">
            {{-- Big Hero Showcase Card (Left, Featured) --}}
            <div class="curated-hero-col" data-curated-item="{{ $featuredCol['id'] }}" data-motion="fade-right">
                <a href="{{ $featuredCol['url'] }}" class="curated-card-hero" data-tilt="true">
                    <div class="curated-media-box hero-box">
                        <img src="{{ $featuredCol['image'] }}" alt="{{ $featuredCol['title'] }}" class="curated-bg-img" loading="lazy">
                        <div class="curated-overlay-dark"></div>
                        <div class="curated-gold-sheen"></div>

                        {{-- Floating Top Bar --}}
                        <div class="curated-top-meta">
                            <span class="curated-badge-royal">
                                <i class="bi bi-crown me-1"></i> {{ $featuredCol['badge'] }}
                            </span>
                            <span class="curated-price-pill">
                                {{ $featuredCol['price_from'] }}
                            </span>
                        </div>

                        {{-- Floating Feature Tags (Lookbook Hotspots) --}}
                        <div class="curated-lookbook-tags d-none d-sm-flex">
                            @foreach($featuredCol['tags'] as $tag)
                            <span class="lookbook-tag pulse-ring-glow">
                                <i class="bi bi-check2-circle me-1"></i> {{ $tag }}
                            </span>
                            @endforeach
                        </div>

                        {{-- Bottom Card Content --}}
                        <div class="curated-hero-content">
                            <span class="curated-tag-line">{{ $featuredCol['tag'] }}</span>
                            <h3 class="curated-hero-title">{{ $featuredCol['title'] }}</h3>
                            <p class="curated-hero-desc">{{ $featuredCol['desc'] }}</p>

                            <div class="curated-btn-row">
                                <span class="btn-curated-action">
                                    <span>{{ $featuredCol['cta'] }}</span>
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                                <span class="curated-ready-hint d-none d-md-inline-block">
                                    <i class="bi bi-box2-heart me-1"></i> Ready to Ship
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Right Stacked Dual Cards (Other Curations) --}}
            <div class="curated-stack-col" data-motion="fade-left">
                @foreach($otherCols as $cIndex => $col)
                <div class="curated-sub-item" data-curated-item="{{ $col['id'] }}" data-motion="fade-up" data-motion-delay="{{ ($cIndex + 1) * 150 }}">
                    <a href="{{ $col['url'] }}" class="curated-card-sub" data-tilt="true">
                        <div class="curated-media-box sub-box">
                            <img src="{{ $col['image'] }}" alt="{{ $col['title'] }}" class="curated-bg-img" loading="lazy">
                            <div class="curated-overlay-dark"></div>
                            <div class="curated-gold-sheen"></div>

                            {{-- Top Meta --}}
                            <div class="curated-top-meta">
                                <span class="curated-badge-royal">
                                    <i class="bi bi-stars me-1"></i> {{ $col['badge'] }}
                                </span>
                                <span class="curated-price-pill">
                                    {{ $col['price_from'] }}
                                </span>
                            </div>

                            {{-- Content --}}
                            <div class="curated-sub-content">
                                <span class="curated-tag-line">{{ $col['tag'] }}</span>
                                <h4 class="curated-sub-title">{{ $col['title'] }}</h4>
                                <p class="curated-sub-desc">{{ $col['desc'] }}</p>

                                <div class="curated-sub-action">
                                    <span class="curated-action-link">
                                        <span>{{ $col['cta'] }}</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </span>
                                    <div class="curated-pill-tags-mini d-none d-sm-flex">
                                        @foreach($col['tags'] as $tag)
                                        <span class="mini-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    7. THE BOUTIQUE SHOPPING PRIVILEGE (BENEFITS)
=================================================== --}}
<section class="luna-benefits py-5 position-relative">
    <div class="container position-relative z-1">
        <div class="row g-3 g-md-4">
            @foreach([
                ['bi-truck', 'Express Global Shipping', 'Free delivery on orders over ₹999 across India & fast dispatch to UK.', '01'],
                ['bi-arrow-repeat', '7-Day Bespoke Returns', 'Hassle-free easy returns with dedicated concierge assistance.', '02'],
                ['bi-patch-check', '100% Handloom Certified', 'Authentic pure zari weaves directly sourced from master artisans.', '03'],
                ['bi-shield-lock', 'Bank-Grade Secure Checkout', 'End-to-end encrypted payments with trusted international gateways.', '04'],
            ] as [$icon, $title, $text, $num])
            <div class="col-6 col-lg-3" data-motion="fade-up" data-motion-delay="{{ (int)$num * 100 }}">
                <div class="luxury-benefit-card">
                    <span class="benefit-serial">{{ $num }}</span>
                    <div class="benefit-icon-ring">
                        <i class="bi {{ $icon }}"></i>
                    </div>
                    <h5 class="benefit-title">{{ $title }}</h5>
                    <p class="benefit-desc">{{ $text }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================
    8. KATHIRAZHAGI PRIVILEGE CLUB (REWARDS)
=================================================== --}}
<section class="py-5 my-3 position-relative" id="privilegeClub">
    <div class="container position-relative z-1" data-motion="fade-up">
        <div class="rewards-wrapper p-4 p-md-5 rounded-4 position-relative overflow-hidden">
            <div class="rewards-bg-glow"></div>

            <div class="row align-items-center position-relative z-1 g-4 text-center text-md-start">
                <div class="col-12 col-lg-3 mb-2 mb-lg-0 border-end-lg">
                    <span class="rewards-eyebrow"><i class="bi bi-crown-fill text-gold me-1"></i> VIP PRIVILEGE</span>
                    <h3 class="text-white fw-bold mb-2" style="font-size:2.2rem; font-family:'Playfair Display', serif;">
                        {{ $brandShort }}<br><span style="color:var(--brand-secondary);">Rewards Club</span>
                    </h3>
                    <p class="text-white-50 mb-0">Experience couture fashion with bespoke member privileges.</p>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="row g-3 g-md-4">
                        @foreach([
                        ['bi-gift-fill', 'Join VIP Rewards', 'Earn points on every purchase, unlock bespoke anniversary gifts and early access.', 'Join Club', $joinUrl],
                        ['bi-envelope-paper-heart-fill','Complimentary 10% Off', 'Subscribe to our royal gazette to receive an instant welcome privilege code.', 'Claim 10% Off', '#luna-newsletter'],
                        ['bi-stars', 'Private Styling Consult', 'Schedule a one-on-one virtual styling session with our bespoke saree draper.', 'Explore Stylist', route('shop')],
                        ] as [$icon, $title, $text, $cta, $url])
                        <div class="col-md-4">
                            <div class="reward-feature-card">
                                <div class="reward-icon-box"><i class="bi {{ $icon }}"></i></div>
                                <h6 class="text-white fw-semibold mb-2">{{ $title }}</h6>
                                <p class="text-white-50 small mb-3">{{ $text }}</p>
                                <a href="{{ $url }}" class="reward-link">{{ $cta }} <i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    9. CUSTOMER STORIES & TESTIMONIAL CAROUSEL
=================================================== --}}
<section class="feedback-carousel-section py-5 position-relative" id="customer-feedback">
    <div class="container position-relative z-1">
        {{-- Header with Navigation Controls --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-lg-5 pb-2" data-motion="fade-up">
            <div>
                <div class="cat-eyebrow-badge mb-2">
                    <i class="bi bi-chat-heart-fill"></i>
                    <span>LOVED BY 5,000+ PATRONS</span>
                </div>
                <h2 class="curated-section-heading mb-1">Customer Stories & Celebrations</h2>
                <p class="curated-section-sub mb-0">
                    Real words from patrons celebrating life's most precious occasions in Kathirazhagi designs.
                </p>
            </div>
            <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
                <button type="button" class="fb-carousel-nav-btn magnetic-btn" id="fbPrevBtn" aria-label="Previous review">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="fb-carousel-nav-btn magnetic-btn" id="fbNextBtn" aria-label="Next review">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        {{-- Carousel Container --}}
        <div class="fb-carousel-wrapper position-relative" data-motion="fade-up" data-motion-delay="150">
            <div class="fb-carousel-track" id="fbCarouselTrack">
                @foreach($reviews as $index => $review)
                <div class="fb-slide-card" data-slide-index="{{ $index }}">
                    <div class="fb-card-inner" data-tilt="true">
                        {{-- Patron Image Box --}}
                        <div class="fb-media-box">
                            <img src="{{ asset('frontend/images/' . $review['img']) }}" alt="{{ $review['name'] }}" class="fb-img" loading="lazy">
                            <div class="fb-img-gradient"></div>

                            {{-- Verified Badge --}}
                            <span class="fb-badge-verified">
                                <i class="bi bi-patch-check-fill text-gold me-1"></i> Verified Patron
                            </span>

                            {{-- Rating Chip --}}
                            <div class="fb-rating-chip">
                                <div class="fb-stars">
                                    @for($i = 0; $i < ($review['rating'] ?? 5); $i++)
                                    <i class="bi bi-star-fill text-gold"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        {{-- Review Content --}}
                        <div class="fb-body">
                            {{-- Product Purchased Tag --}}
                            @if(!empty($review['product']))
                            <div class="fb-product-pill">
                                <i class="bi bi-bag-check-fill me-1 text-gold"></i> {{ $review['product'] }}
                            </div>
                            @endif

                            {{-- Title & Testimonial --}}
                            <h5 class="fb-title">{{ $review['title'] ?? 'Wonderful Experience' }}</h5>
                            <p class="fb-testimonial">
                                “{{ $review['text'] }}”
                            </p>

                            {{-- Patron Meta --}}
                            <div class="fb-footer">
                                <div class="fb-avatar-initials">
                                    {{ substr($review['name'], 0, 1) }}
                                </div>
                                <div class="fb-patron-info">
                                    <span class="fb-name">{{ $review['name'] }}</span>
                                    <span class="fb-meta">
                                        {{ $review['city'] ?? 'India' }} • {{ $review['date'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Carousel Indicators / Dots --}}
        <div class="fb-carousel-dots d-flex justify-content-center gap-2 mt-4" id="fbCarouselDots">
            @foreach($reviews as $index => $review)
            <button type="button" class="fb-dot {{ $index === 0 ? 'active' : '' }}" data-dot-index="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================
    10. VIP CONCIERGE & ATELIER LOCATION
=================================================== --}}
<section class="container py-5 mb-5 position-relative" id="contact-us" data-motion="fade-up">
    <div class="text-center mb-5" data-motion="fade-up">
        <div class="cat-eyebrow-badge mb-2">
            <i class="bi bi-building"></i>
            <span>GLOBAL ATELIERS</span>
        </div>
        <h2 class="curated-section-heading mb-2">Connect with Our Stylists</h2>
        <p class="curated-section-sub mx-auto">Personalized styling consultations, custom bridal weaves, and worldwide express concierge.</p>
    </div>

    <div class="contact-showcase shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-6 p-5 contact-pane bg-white" data-motion="fade-right">
                <div class="contact-icon-wrapper mb-4"><i class="bi bi-geo-alt-fill"></i></div>
                <h3 class="contact-region-title mb-4">India Headquarters</h3>
                <ul class="list-unstyled contact-details">
                    <li class="d-flex mb-3">
                        <i class="bi bi-building text-gold me-3 mt-1"></i>
                        <span>1/150 Agaraharam Street,<br>Mullippallam, Sholavanthan,<br>Tamil Nadu, India</span>
                    </li>
                    <li class="d-flex">
                        <i class="bi bi-mailbox text-gold me-3 mt-1"></i>
                        <span>Pincode 625207</span>
                    </li>
                </ul>
                <div class="mt-4">
                    <a href="https://wa.me/+918072000915" target="_blank" class="btn-royal-gold magnetic-btn">
                        <i class="bi bi-whatsapp me-2"></i> Chat with Indian Atelier
                    </a>
                </div>
            </div>

            <div class="col-md-6 p-5 contact-pane contact-pane-alt" data-motion="fade-left">
                <div class="contact-icon-wrapper mb-4"><i class="bi bi-globe-americas"></i></div>
                <h3 class="contact-region-title mb-4">UK Location & Global Orders</h3>
                <ul class="list-unstyled contact-details">
                    <li class="d-flex mb-3">
                        <i class="bi bi-pin-map text-gold me-3 mt-1"></i>
                        <span>Stafford, United Kingdom</span>
                    </li>
                    <li class="d-flex mb-4">
                        <i class="bi bi-telephone text-gold me-3 mt-1"></i>
                        <a href="tel:+447393129732" class="contact-link">+44 7393 129732</a>
                    </li>
                </ul>
                <div class="shipping-badge mb-4"><i class="bi bi-airplane me-2"></i> International Courier to UK, USA & Worldwide</div>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================
    11. THE ROYAL GAZETTE (NEWSLETTER)
=================================================== --}}
<section class="container py-4 mb-5" id="luna-newsletter" data-motion="fade-up">
    <div class="luna-newsletter royal-gazette-box">
        <span class="gazette-badge"><i class="bi bi-envelope-paper-heart-fill me-1"></i> THE ROYAL GAZETTE</span>
        <h3 class="gazette-title">Be Part of Our Royal Circle</h3>
        <p class="gazette-sub">Receive invitations to private lookbook previews, festive trunk shows, and secret archival discounts.</p>

        <form class="mx-auto mt-4" style="max-width:460px" onsubmit="handleNewsletterSubmit(event, this)">
            <div class="gazette-input-wrap d-flex">
                <input type="email" class="form-control gazette-input" placeholder="Enter your email address" aria-label="Email address" required>
                <button type="submit" class="btn-gazette-submit magnetic-btn">
                    <span>Subscribe</span>
                    <i class="bi bi-arrow-right ms-1"></i>
                </button>
            </div>
            <small class="text-white-50 d-block mt-3 gazette-privacy">
                <i class="bi bi-shield-check text-gold me-1"></i> We respect your privacy. Unsubscribe at any time.
            </small>
        </form>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ===================================================
       1. GLOBAL LUXURY TOKENS & KEYFRAME ANIMATIONS
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
        transform: translateY(35px);
    }

    [data-motion="fade-down"] {
        transform: translateY(-35px);
    }

    [data-motion="fade-left"] {
        transform: translateX(40px);
    }

    [data-motion="fade-right"] {
        transform: translateX(-40px);
    }

    [data-motion="zoom-in"] {
        transform: scale(0.92);
    }

    /* Active Motion State */
    [data-motion].motion-active {
        opacity: 1 !important;
        transform: translate(0, 0) scale(1) !important;
    }

    /* Subtle Gold Shimmer Text */
    .gold-gradient-text {
        background: linear-gradient(135deg, #FFF6D6 0%, #D4AF37 45%, #E5C358 75%, #FBF3CE 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .text-gold {
        color: var(--gold-primary) !important;
    }

    /* Floating Gentle Motion */
    .float-motion {
        animation: floatGentle 5s ease-in-out infinite alternate;
    }

    @keyframes floatGentle {
        0% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-10px) rotate(0.6deg);
        }
        100% {
            transform: translateY(0px) rotate(0deg);
        }
    }

    /* Pulse Glow for Badges & Hotspots */
    .pulse-ring-glow {
        position: relative;
    }

    .pulse-ring-glow::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: inherit;
        border: 1.5px solid var(--gold-primary);
        animation: pulseRingAura 2.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) infinite;
        pointer-events: none;
    }

    @keyframes pulseRingAura {
        0% {
            transform: scale(0.95);
            opacity: 0.9;
        }
        70% {
            transform: scale(1.15);
            opacity: 0;
        }
        100% {
            transform: scale(1.15);
            opacity: 0;
        }
    }

    /* ===================================================
       2. EDITORIAL HERO SECTION STYLING
    =================================================== */
    .boutique-hero-luxury {
        background: radial-gradient(circle at 75% 20%, #451b47 0%, #2e102f 45%, #180819 100%);
        min-height: 85vh;
        display: flex;
        align-items: center;
        color: #ffffff;
        position: relative;
        padding-top: 30px;
        padding-bottom: 40px;
    }

    .min-vh-hero {
        min-height: calc(85vh - 76px);
    }

    .hero-ambient-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        pointer-events: none;
        z-index: 1;
    }

    .glow-1 {
        top: -10%;
        right: 10%;
        width: 480px;
        height: 480px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.22) 0%, transparent 70%);
    }

    .glow-2 {
        bottom: 5%;
        left: -5%;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(139, 75, 124, 0.28) 0%, transparent 70%);
    }

    .hero-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(212, 175, 55, 0.08) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
        z-index: 1;
        opacity: 0.6;
    }

    /* Royal Eyebrow Badge */
    .hero-royal-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 18px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 50px;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: var(--gold-light);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .pill-sparkle {
        color: var(--gold-primary);
        font-size: 0.9rem;
    }

    .pill-divider {
        color: rgba(212, 175, 55, 0.6);
    }

    .pill-sub {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.72rem;
    }

    /* Headline & Lead */
    .hero-editorial-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 4.5vw, 4.2rem);
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: -0.5px;
        color: #ffffff;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    }

    .hero-editorial-lead {
        font-size: clamp(0.95rem, 1.2vw, 1.12rem);
        color: rgba(255, 255, 255, 0.86);
        line-height: 1.7;
        max-width: 580px;
    }

    /* Buttons */
    .btn-royal-gold {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 13px 30px;
        border-radius: 50px;
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        font-weight: 700;
        font-size: 0.88rem;
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

    .btn-royal-glass {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 13px 28px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        color: #ffffff;
        font-weight: 600;
        font-size: 0.88rem;
        letter-spacing: 0.5px;
        border: 1.5px solid rgba(212, 175, 55, 0.45);
        transition: all 0.35s var(--ease-luxury);
        text-decoration: none;
    }

    .btn-royal-glass:hover {
        background: rgba(212, 175, 55, 0.15);
        border-color: var(--gold-primary);
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* Patron Social Proof */
    .hero-patron-proof {
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.12);
    }

    .patron-avatar-group {
        display: flex;
        align-items: center;
    }

    .patron-mini-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #2e102f;
        margin-left: -10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .patron-mini-avatar:first-child {
        margin-left: 0;
    }

    .patron-count-badge {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--gold-primary);
        color: #2e102f;
        font-weight: 700;
        font-size: 0.72rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #2e102f;
        margin-left: -10px;
    }

    .stars-gold i {
        color: var(--gold-primary);
        font-size: 0.85rem;
    }

    .proof-sub {
        display: block;
        font-size: 0.78rem;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 2px;
    }

    /* Right Showcase 3D Card */
    .hero-showcase-container {
        position: relative;
        max-width: 440px;
        margin: 0 auto;
        perspective: 1000px;
    }

    .hero-rotating-seal {
        position: absolute;
        top: -30px;
        right: -25px;
        width: 120px;
        height: 120px;
        z-index: 10;
        pointer-events: none;
    }

    .seal-svg-ring {
        width: 100%;
        height: 100%;
        animation: spinSlow 22s linear infinite;
    }

    @keyframes spinSlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .seal-svg-text {
        fill: var(--gold-primary);
        font-size: 11px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .seal-center-crest {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 44px;
        height: 44px;
        background: #2e102f;
        border-radius: 50%;
        border: 1.5px solid var(--gold-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    .hero-couture-card {
        border-radius: 28px;
        overflow: hidden;
        background: #2e102f;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(212, 175, 55, 0.3);
        transition: transform 0.4s var(--ease-luxury), box-shadow 0.4s var(--ease-luxury);
        transform-style: preserve-3d;
    }

    .hero-card-inner {
        position: relative;
        aspect-ratio: 3 / 4.1;
        overflow: hidden;
        border-radius: 28px;
    }

    .hero-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 20%;
        transition: transform 0.8s var(--ease-luxury);
    }

    .hero-couture-card:hover .hero-card-img {
        transform: scale(1.06);
    }

    .hero-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.05) 0%, rgba(46, 16, 47, 0.25) 50%, rgba(31, 11, 32, 0.94) 100%);
    }

    .hero-card-gold-border {
        position: absolute;
        inset: 12px;
        border: 1.5px solid rgba(212, 175, 55, 0.4);
        border-radius: 20px;
        pointer-events: none;
        transition: all 0.4s ease;
    }

    .hero-couture-card:hover .hero-card-gold-border {
        inset: 8px;
        border-color: rgba(212, 175, 55, 0.8);
        box-shadow: inset 0 0 20px rgba(212, 175, 55, 0.2);
    }

    /* Hotspot on card */
    .hero-hotspot-tag {
        position: absolute;
        top: 25px;
        left: 25px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: rgba(46, 16, 47, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.4);
        border-radius: 30px;
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    .hotspot-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--gold-primary);
        display: inline-block;
    }

    .hero-card-meta {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 26px 24px;
        z-index: 3;
    }

    .hero-card-tag {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--gold-primary);
        display: block;
        margin-bottom: 4px;
    }

    .hero-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
    }

    .hero-card-price {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--gold-light);
    }

    .hero-card-link {
        font-size: 0.78rem;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Floating mini chip */
    .floating-chip-silk {
        position: absolute;
        bottom: -20px;
        left: -20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(212, 175, 55, 0.5);
        border-radius: 16px;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        text-align: left;
        z-index: 4;
        animation: floatGentle 4.5s ease-in-out infinite alternate 1s;
    }

    .chip-icon {
        font-size: 1.4rem;
        display: flex;
        align-items: center;
    }

    .chip-title {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: #2e102f;
        line-height: 1.2;
    }

    .chip-sub {
        display: block;
        font-size: 0.7rem;
        color: #777;
    }

    /* Scroll prompter */
    .hero-scroll-prompter {
        padding-top: 30px;
    }

    .scroll-down-link {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.7);
        transition: color 0.3s ease;
    }

    .scroll-down-link:hover {
        color: var(--gold-primary);
    }

    .scroll-mouse {
        width: 22px;
        height: 36px;
        border: 2px solid rgba(212, 175, 55, 0.7);
        border-radius: 15px;
        display: flex;
        justify-content: center;
        padding-top: 6px;
    }

    .scroll-wheel {
        width: 4px;
        height: 8px;
        background: var(--gold-primary);
        border-radius: 4px;
        animation: scrollWheelPulse 2s infinite;
    }

    @keyframes scrollWheelPulse {
        0% { transform: translateY(0); opacity: 1; }
        80% { transform: translateY(12px); opacity: 0; }
        100% { transform: translateY(0); opacity: 0; }
    }

    .scroll-text {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* ===================================================
       3. INFINITE LUXURY MARQUEE RIBBON
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
       4. SHOP BY CATEGORY - LUXURY REDESIGN
    =================================================== */
    .boutique-categories-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
        padding: 70px 0 80px;
    }

    .cat-eyebrow-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 50px;
        background: rgba(46, 16, 47, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.35);
        color: var(--brand-primary);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .cat-eyebrow-badge i {
        color: var(--brand-secondary);
        font-size: 0.85rem;
    }

    .badge-on-dark {
        background: rgba(212, 175, 55, 0.15) !important;
        border-color: rgba(212, 175, 55, 0.5) !important;
        color: var(--gold-light) !important;
    }

    .cat-main-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.35rem;
        font-weight: 700;
        color: var(--brand-primary);
        letter-spacing: -0.3px;
    }

    .cat-sub-title {
        font-size: 0.96rem;
        color: #666;
        max-width: 540px;
        line-height: 1.6;
    }

    .btn-cat-view-all {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 22px;
        background: #fff;
        color: var(--brand-primary);
        border: 1.5px solid rgba(46, 16, 47, 0.15);
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        box-shadow: 0 4px 12px rgba(46, 16, 47, 0.04);
        text-decoration: none;
    }

    .btn-cat-view-all:hover {
        background: var(--brand-primary);
        color: #fff;
        border-color: var(--brand-primary);
        box-shadow: 0 8px 20px rgba(46, 16, 47, 0.2);
        transform: translateY(-2px);
    }

    .boutique-cat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-top: 15px;
    }

    @media (max-width: 1199px) {
        .boutique-cat-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }
    }

    @media (max-width: 767px) {
        .boutique-cat-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .boutique-cat-card-wrapper:last-child:nth-child(odd) {
            grid-column: span 2;
        }

        .boutique-cat-card-wrapper:last-child:nth-child(odd) .cat-media {
            aspect-ratio: 16 / 9;
        }

        .cat-main-title {
            font-size: 1.85rem;
        }
    }

    .boutique-cat-card-wrapper {
        height: 100%;
    }

    .boutique-cat-card {
        display: block;
        height: 100%;
        text-decoration: none;
        color: inherit;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(46, 16, 47, 0.07);
        transition: transform 0.45s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.45s cubic-bezier(0.165, 0.84, 0.44, 1);
        transform-style: preserve-3d;
    }

    .boutique-cat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(46, 16, 47, 0.18), 0 0 0 1.5px rgba(212, 175, 55, 0.7);
    }

    .cat-media {
        position: relative;
        width: 100%;
        aspect-ratio: 3 / 4.2;
        overflow: hidden;
        border-radius: 20px;
        background: #f5f0eb;
    }

    .cat-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 25%;
        transition: transform 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .boutique-cat-card:hover .cat-img {
        transform: scale(1.08);
    }

    .cat-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #FAF8F1, #f0e9df);
    }

    .cat-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg,
                rgba(46, 16, 47, 0.02) 0%,
                rgba(46, 16, 47, 0.18) 45%,
                rgba(46, 16, 47, 0.85) 85%,
                rgba(46, 16, 47, 0.95) 100%);
        transition: background 0.4s ease;
    }

    .boutique-cat-card:hover .cat-overlay {
        background: linear-gradient(180deg,
                rgba(46, 16, 47, 0.05) 0%,
                rgba(46, 16, 47, 0.25) 40%,
                rgba(46, 16, 47, 0.90) 80%,
                rgba(46, 16, 47, 0.98) 100%);
    }

    .cat-chip-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 3;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.35);
        border-radius: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .boutique-cat-card:hover .cat-chip-badge {
        background: #ffffff;
        transform: scale(1.04);
        border-color: rgba(212, 175, 55, 0.7);
    }

    .cat-chip-icon {
        color: var(--brand-secondary);
        font-size: 0.75rem;
        display: flex;
        align-items: center;
    }

    .cat-chip-text {
        color: var(--brand-primary);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .cat-accent-frame {
        position: absolute;
        inset: 10px;
        border-radius: 14px;
        border: 1px solid rgba(212, 175, 55, 0.25);
        pointer-events: none;
        transition: all 0.4s ease;
        z-index: 2;
    }

    .boutique-cat-card:hover .cat-accent-frame {
        inset: 7px;
        border-color: rgba(212, 175, 55, 0.75);
    }

    .cat-content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 18px 16px;
        z-index: 3;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .cat-desc-tag {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--brand-secondary);
        margin-bottom: 2px;
        display: inline-block;
        opacity: 0.95;
    }

    .cat-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        line-height: 1.25;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    }

    .cat-cta-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .cat-cta-text {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.88);
    }

    .cat-cta-circle {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(212, 175, 55, 0.2);
        border: 1px solid rgba(212, 175, 55, 0.4);
        color: var(--brand-secondary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .boutique-cat-card:hover .cat-cta-circle {
        background: var(--brand-secondary);
        color: var(--brand-primary);
        border-color: var(--brand-secondary);
        transform: translateX(4px);
    }

    /* ===================================================
       5. ARTISANAL HERITAGE STORY & LIVE COUNTERS
    =================================================== */
    .heritage-story-section {
        background: #250b26;
        color: #ffffff;
        padding: 85px 0;
    }

    .heritage-ambient-pattern {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 10% 50%, rgba(212, 175, 55, 0.08) 0%, transparent 60%),
                    radial-gradient(circle at 90% 80%, rgba(139, 75, 124, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .heritage-image-frame-wrap {
        max-width: 520px;
        margin: 0 auto;
    }

    .heritage-img-main {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        border: 1.5px solid rgba(212, 175, 55, 0.35);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
    }

    .heritage-gold-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 60%, rgba(37, 11, 38, 0.85) 100%);
    }

    .heritage-floating-seal {
        position: absolute;
        bottom: -25px;
        right: -20px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: #2e102f;
        border: 2px solid var(--gold-primary);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 12px;
        z-index: 3;
    }

    .seal-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .seal-title {
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 1px;
        color: #ffffff;
        text-transform: uppercase;
    }

    .seal-subtitle {
        font-size: 0.65rem;
        color: var(--gold-primary);
        font-weight: 600;
    }

    .heritage-accent-box {
        position: absolute;
        top: -15px;
        left: -15px;
        width: 100%;
        height: 100%;
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 28px;
        pointer-events: none;
        z-index: -1;
    }

    .heritage-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 3.5vw, 3rem);
        font-weight: 700;
        line-height: 1.15;
    }

    .heritage-text {
        font-size: 1.02rem;
        color: rgba(255, 255, 255, 0.82);
        line-height: 1.7;
    }

    /* Counters */
    .heritage-counter-grid {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 24px 0;
    }

    .counter-box {
        text-align: center;
    }

    .counter-num {
        display: inline;
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--gold-primary);
        line-height: 1;
    }

    .counter-plus {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gold-primary);
        vertical-align: top;
    }

    .counter-label {
        font-size: 0.74rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 6px;
        margin-bottom: 0;
    }

    /* ===================================================
       6. CURATED NEW ARRIVALS & INTERACTIVE PRODUCT CARDS
    =================================================== */
    .luna-new-arrivals {
        padding: 70px 0 80px;
        background: #ffffff;
    }

    .product-filter-tabs {
        background: rgba(46, 16, 47, 0.05);
        border: 1px solid rgba(46, 16, 47, 0.1);
    }

    .prod-tab-pill {
        border: none;
        background: transparent;
        padding: 7px 18px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--brand-primary);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .prod-tab-pill.active {
        background: var(--brand-primary);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(46, 16, 47, 0.25);
    }

    /* Luxury Product Card */
    .luxury-product-card {
        border-radius: 18px;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid rgba(46, 16, 47, 0.08);
        box-shadow: 0 8px 22px rgba(46, 16, 47, 0.05);
        transition: transform 0.45s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.45s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .luxury-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 38px rgba(46, 16, 47, 0.14), 0 0 0 1.5px rgba(212, 175, 55, 0.5);
    }

    .luna-product-img-wrap {
        aspect-ratio: 3 / 4;
        background: #fbf9f6;
        position: relative;
    }

    .luna-product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .luxury-product-card:hover .luna-product-img {
        transform: scale(1.08);
    }

    /* Status Badges */
    .luna-product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #2e102f;
        color: #ffffff;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 4px 10px;
        border-radius: 20px;
        z-index: 3;
    }

    .offer-badge-red {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #c2185b;
        color: #ffffff;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 20px;
        z-index: 3;
        box-shadow: 0 3px 8px rgba(194, 24, 91, 0.3);
    }

    .badge-royal-edit {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(135deg, #2e102f, #511c52);
        color: var(--gold-primary);
        border: 1px solid rgba(212, 175, 55, 0.4);
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 20px;
        z-index: 3;
    }

    /* Quick Action Icons */
    .product-quick-actions {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        z-index: 3;
        opacity: 0;
        transform: translateX(10px);
        transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .luxury-product-card:hover .product-quick-actions {
        opacity: 1;
        transform: translateX(0);
    }

    .quick-action-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border: 1px solid rgba(46, 16, 47, 0.1);
        color: var(--brand-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-decoration: none;
    }

    .quick-action-btn:hover {
        background: var(--brand-primary);
        color: var(--gold-primary);
        border-color: var(--brand-primary);
        transform: scale(1.1);
    }

    /* Quick Add Bar Slideup */
    .quick-add-slideup {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px;
        background: linear-gradient(180deg, transparent 0%, rgba(46, 16, 47, 0.75) 100%);
        transform: translateY(100%);
        transition: transform 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
        z-index: 3;
    }

    .luxury-product-card:hover .quick-add-slideup {
        transform: translateY(0);
    }

    .btn-quick-add {
        display: block;
        width: 100%;
        text-align: center;
        background: #ffffff;
        color: var(--brand-primary);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 7px 12px;
        border-radius: 25px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.25s ease;
    }

    .btn-quick-add:hover {
        background: var(--gold-primary);
        color: #2e102f;
    }

    .luna-product-info {
        padding: 16px 14px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-cat-label {
        font-size: 0.68rem;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.8px;
        color: var(--gold-dark);
        margin-bottom: 2px;
    }

    .luna-product-name {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--brand-primary);
        margin-bottom: 6px;
        text-decoration: none;
        line-height: 1.35;
        transition: color 0.3s ease;
    }

    .luna-product-name:hover {
        color: var(--brand-accent);
    }

    .luna-product-price {
        font-size: 1rem;
        font-weight: 700;
        color: var(--brand-primary);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: auto;
    }

    .current-price {
        color: var(--brand-primary);
    }

    .luna-product-old-price {
        font-size: 0.85rem;
        text-decoration: line-through;
        color: #999;
        font-weight: 500;
    }

    .discount-text-red {
        font-size: 0.72rem;
        color: #c2185b;
        font-weight: 700;
        background: #fce4ec;
        padding: 2px 6px;
        border-radius: 12px;
    }

    .luna-color-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 4px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .luna-color-dot.active,
    .luna-color-dot:hover {
        transform: scale(1.3);
        outline: 1.5px solid var(--gold-primary);
        outline-offset: 1px;
    }

    /* Product Filter Dimming */
    .product-item-col {
        transition: all 0.4s var(--ease-luxury);
    }

    .product-item-col.tab-hidden {
        display: none !important;
    }

    /* ===================================================
       7. CURATED SIGNATURE COLLECTIONS (EDITORIAL)
    =================================================== */
    .curated-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 50%, #FFFFFF 100%);
        padding: 70px 0 85px;
    }

    .curated-section-heading {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--brand-primary);
        letter-spacing: -0.5px;
    }

    .curated-section-sub {
        font-size: 1.05rem;
        color: #666;
        max-width: 680px;
        line-height: 1.6;
    }

    .curated-filter-pill {
        background: #ffffff;
        border: 1.5px solid rgba(46, 16, 47, 0.15);
        color: var(--brand-primary);
        border-radius: 50px;
        padding: 9px 22px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        box-shadow: 0 4px 12px rgba(46, 16, 47, 0.04);
        display: inline-flex;
        align-items: center;
    }

    .curated-filter-pill:hover {
        border-color: var(--brand-secondary);
        color: var(--brand-primary);
        transform: translateY(-2px);
    }

    .curated-filter-pill.active {
        background: var(--brand-primary);
        color: #ffffff;
        border-color: var(--brand-primary);
        box-shadow: 0 8px 22px rgba(46, 16, 47, 0.25);
    }

    .curated-editorial-grid {
        display: grid;
        grid-template-columns: 1.25fr 1fr;
        gap: 26px;
        align-items: stretch;
        margin-top: 20px;
    }

    @media (max-width: 991px) {
        .curated-editorial-grid {
            grid-template-columns: 1fr;
            gap: 22px;
        }
    }

    .curated-hero-col {
        height: 100%;
        transition: all 0.4s ease;
    }

    .curated-stack-col {
        display: flex;
        flex-direction: column;
        gap: 24px;
        height: 100%;
    }

    .curated-sub-item {
        flex: 1;
        transition: all 0.4s ease;
    }

    .curated-card-hero,
    .curated-card-sub {
        display: block;
        height: 100%;
        text-decoration: none;
        color: #ffffff;
    }

    .curated-media-box {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 24px;
        overflow: hidden;
        background: #2e102f;
        box-shadow: 0 15px 35px rgba(46, 16, 47, 0.1);
        transition: transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .hero-box {
        min-height: 590px;
    }

    .sub-box {
        min-height: 283px;
    }

    @media (max-width: 767px) {
        .hero-box {
            min-height: 480px;
        }

        .sub-box {
            min-height: 320px;
        }
    }

    .curated-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 20%;
        transition: transform 0.85s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .curated-card-hero:hover .curated-bg-img,
    .curated-card-sub:hover .curated-bg-img {
        transform: scale(1.07);
    }

    .curated-card-hero:hover .curated-media-box,
    .curated-card-sub:hover .curated-media-box {
        transform: translateY(-8px);
        box-shadow: 0 25px 60px rgba(46, 16, 47, 0.22);
    }

    .curated-overlay-dark {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(46, 16, 47, 0.2) 0%,
            rgba(46, 16, 47, 0.35) 40%,
            rgba(46, 16, 47, 0.88) 80%,
            rgba(46, 16, 47, 0.97) 100%
        );
        transition: background 0.4s ease;
    }

    .curated-gold-sheen {
        position: absolute;
        inset: 12px;
        border-radius: 18px;
        border: 1.5px solid rgba(212, 175, 55, 0.35);
        pointer-events: none;
        transition: all 0.4s ease;
        z-index: 2;
    }

    .curated-card-hero:hover .curated-gold-sheen,
    .curated-card-sub:hover .curated-gold-sheen {
        inset: 8px;
        border-color: rgba(212, 175, 55, 0.85);
        box-shadow: inset 0 0 25px rgba(212, 175, 55, 0.2);
    }

    .curated-top-meta {
        position: absolute;
        top: 22px;
        left: 22px;
        right: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 3;
    }

    .curated-badge-royal {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 30px;
        background: rgba(46, 16, 47, 0.88);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(212, 175, 55, 0.45);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .curated-badge-royal i {
        color: var(--brand-secondary);
    }

    .curated-price-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(212, 175, 55, 0.45);
        color: var(--brand-primary);
        font-size: 0.78rem;
        font-weight: 700;
    }

    .curated-lookbook-tags {
        position: absolute;
        top: 75px;
        left: 22px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 3;
    }

    .lookbook-tag {
        display: inline-flex;
        align-items: center;
        padding: 5px 14px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.35);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 600;
        width: fit-content;
    }

    .curated-hero-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 36px 30px;
        z-index: 3;
    }

    .curated-tag-line {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--brand-secondary);
        margin-bottom: 6px;
        display: block;
    }

    .curated-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.25rem;
        font-weight: 700;
        color: #ffffff;
        line-height: 1.2;
        margin-bottom: 10px;
    }

    .curated-hero-desc {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.88);
        max-width: 90%;
        line-height: 1.5;
        margin-bottom: 22px;
    }

    .curated-btn-row {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .btn-curated-action {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 28px;
        border-radius: 50px;
        background: linear-gradient(135deg, var(--brand-secondary), #c2992b);
        color: var(--brand-primary);
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .curated-card-hero:hover .btn-curated-action {
        transform: translateX(4px) scale(1.02);
        box-shadow: 0 10px 25px rgba(212, 175, 55, 0.6);
    }

    .curated-ready-hint {
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 600;
    }

    .curated-ready-hint i {
        color: var(--brand-secondary);
    }

    .curated-sub-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 24px 22px;
        z-index: 3;
    }

    .curated-sub-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        font-weight: 700;
        color: #ffffff;
        line-height: 1.25;
        margin-bottom: 6px;
    }

    .curated-sub-desc {
        font-size: 0.86rem;
        color: rgba(255, 255, 255, 0.84);
        line-height: 1.45;
        margin-bottom: 14px;
        max-width: 95%;
    }

    .curated-sub-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 10px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .curated-action-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--brand-secondary);
        transition: color 0.3s ease, gap 0.3s ease;
    }

    .curated-card-sub:hover .curated-action-link {
        color: #ffffff;
        gap: 12px;
    }

    .curated-pill-tags-mini {
        display: flex;
        gap: 6px;
    }

    .mini-tag {
        font-size: 0.72rem;
        padding: 3px 10px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.15);
        color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .curated-dimmed {
        opacity: 0.25 !important;
        filter: grayscale(80%) !important;
        transform: scale(0.97) !important;
    }

    /* ===================================================
       8. SHOPPING PRIVILEGE CARDS
    =================================================== */
    .luna-benefits {
        background: #ffffff;
        padding: 60px 0;
        border-top: 1px solid rgba(46, 16, 47, 0.06);
    }

    .luxury-benefit-card {
        padding: 30px 24px;
        border-radius: 20px;
        background: #FAF8F1;
        border: 1px solid rgba(212, 175, 55, 0.25);
        height: 100%;
        position: relative;
        transition: all 0.35s var(--ease-luxury);
        overflow: hidden;
    }

    .luxury-benefit-card:hover {
        transform: translateY(-6px);
        background: #ffffff;
        border-color: var(--gold-primary);
        box-shadow: 0 15px 35px rgba(46, 16, 47, 0.1);
    }

    .benefit-serial {
        position: absolute;
        top: 15px;
        right: 20px;
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: rgba(212, 175, 55, 0.2);
    }

    .benefit-icon-ring {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.25), rgba(46, 16, 47, 0.05));
        border: 1.5px solid rgba(212, 175, 55, 0.4);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: var(--brand-primary);
        margin-bottom: 18px;
        transition: transform 0.3s ease;
    }

    .luxury-benefit-card:hover .benefit-icon-ring {
        transform: scale(1.1) rotate(6deg);
        background: var(--gold-primary);
        color: #2e102f;
    }

    .benefit-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--brand-primary);
        margin-bottom: 8px;
    }

    .benefit-desc {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* ===================================================
       9. PRIVILEGE CLUB (REWARDS)
    =================================================== */
    .rewards-wrapper {
        background: #250b26;
        box-shadow: 0 25px 60px rgba(37, 11, 38, 0.45);
        border: 1px solid rgba(212, 175, 55, 0.25);
    }

    .rewards-eyebrow {
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: var(--gold-primary);
        display: block;
        margin-bottom: 8px;
    }

    @media(min-width:992px) {
        .border-end-lg {
            border-right: 1px solid rgba(255, 255, 255, .1);
        }
    }

    .rewards-bg-glow {
        position: absolute;
        top: -50%;
        left: -20%;
        width: 140%;
        height: 200%;
        background: radial-gradient(circle at 80% 20%, rgba(212, 175, 55, .15), transparent 40%),
                    radial-gradient(circle at 20% 80%, rgba(212, 175, 55, .1), transparent 40%);
        pointer-events: none;
    }

    .reward-feature-card {
        padding: 24px;
        border-radius: 16px;
        height: 100%;
        background: rgba(255, 255, 255, .04);
        border: 1px solid rgba(255, 255, 255, .08);
        transition: transform .35s var(--ease-luxury), background .35s ease, border-color .35s ease;
    }

    .reward-feature-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, .08);
        border-color: rgba(212, 175, 55, .4);
    }

    .reward-icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(212, 175, 55, .25), rgba(212, 175, 55, .08));
        color: var(--brand-secondary);
        font-size: 1.5rem;
        margin-bottom: 20px;
        border: 1px solid rgba(212, 175, 55, .3);
    }

    .reward-link {
        color: var(--brand-secondary);
        font-size: .85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-flex;
        align-items: center;
        transition: color .3s ease, gap .3s ease;
        text-decoration: none;
    }

    .reward-link:hover {
        color: #fff;
    }

    /* ===================================================
       10. CUSTOMER STORIES CAROUSEL
    =================================================== */
    .feedback-carousel-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 50%, #FFFFFF 100%);
        padding: 70px 0 85px;
        overflow: hidden;
    }

    .fb-carousel-nav-btn {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #ffffff;
        color: var(--brand-primary);
        border: 1.5px solid rgba(46, 16, 47, 0.15);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        box-shadow: 0 4px 12px rgba(46, 16, 47, 0.05);
    }

    .fb-carousel-nav-btn:hover {
        background: var(--brand-primary);
        color: #ffffff;
        border-color: var(--brand-primary);
        box-shadow: 0 8px 20px rgba(46, 16, 47, 0.2);
        transform: scale(1.06);
    }

    .fb-carousel-wrapper {
        position: relative;
        width: 100%;
    }

    .fb-carousel-track {
        display: flex;
        gap: 24px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        padding: 15px 5px 25px;
        scrollbar-width: none;
        -ms-overflow-style: none;
        -webkit-overflow-scrolling: touch;
    }

    .fb-carousel-track::-webkit-scrollbar {
        display: none;
    }

    .fb-slide-card {
        flex: 0 0 calc((100% - 48px) / 3);
        scroll-snap-align: start;
        transition: transform 0.4s ease;
    }

    @media (max-width: 1199px) {
        .fb-slide-card {
            flex: 0 0 calc((100% - 24px) / 2);
        }
    }

    @media (max-width: 767px) {
        .fb-slide-card {
            flex: 0 0 88%;
        }
    }

    .fb-card-inner {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(46, 16, 47, 0.08);
        box-shadow: 0 10px 30px rgba(46, 16, 47, 0.06);
        transition: transform 0.45s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.45s cubic-bezier(0.165, 0.84, 0.44, 1), border-color 0.45s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .fb-card-inner:hover {
        transform: translateY(-8px);
        box-shadow: 0 22px 45px rgba(46, 16, 47, 0.14), 0 0 0 1.5px rgba(212, 175, 55, 0.6);
        border-color: rgba(212, 175, 55, 0.5);
    }

    .fb-media-box {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
        background: #2e102f;
    }

    .fb-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .fb-card-inner:hover .fb-img {
        transform: scale(1.07);
    }

    .fb-img-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.1) 0%, rgba(46, 16, 47, 0.3) 60%, rgba(46, 16, 47, 0.75) 100%);
        pointer-events: none;
    }

    .fb-badge-verified {
        position: absolute;
        top: 14px;
        left: 14px;
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: var(--brand-primary);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(212, 175, 55, 0.3);
    }

    .fb-rating-chip {
        position: absolute;
        top: 14px;
        right: 14px;
        padding: 4px 10px;
        border-radius: 30px;
        background: rgba(46, 16, 47, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(212, 175, 55, 0.35);
    }

    .fb-stars i {
        font-size: 0.75rem;
        color: var(--brand-secondary);
        margin-right: 1px;
    }

    .fb-body {
        padding: 24px 22px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .fb-product-pill {
        display: inline-flex;
        align-items: center;
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--brand-secondary);
        background: rgba(46, 16, 47, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.25);
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 12px;
        width: fit-content;
    }

    .fb-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--brand-primary);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .fb-testimonial {
        font-size: 0.92rem;
        color: #555555;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
        font-style: italic;
    }

    .fb-footer {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-top: 14px;
        border-top: 1px solid rgba(46, 16, 47, 0.08);
    }

    .fb-avatar-initials {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--brand-primary), var(--brand-accent));
        color: var(--brand-secondary);
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid var(--brand-secondary);
    }

    .fb-patron-info {
        display: flex;
        flex-direction: column;
    }

    .fb-name {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--brand-primary);
    }

    .fb-meta {
        font-size: 0.78rem;
        color: #888888;
    }

    .fb-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(46, 16, 47, 0.2);
        border: none;
        padding: 0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .fb-dot.active {
        width: 28px;
        border-radius: 10px;
        background: var(--brand-primary);
    }

    /* ===================================================
       11. VIP CONCIERGE & CONTACT
    =================================================== */
    .contact-showcase {
        border: 1px solid rgba(0, 0, 0, .05);
        transition: box-shadow .4s ease;
    }

    .contact-showcase:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, .12) !important;
    }

    .contact-pane {
        transition: background-color .4s ease;
    }

    .contact-pane-alt {
        background: #f8f9fa;
    }

    @media(min-width:768px) {
        .contact-pane-alt {
            border-left: 1px solid rgba(0, 0, 0, .08);
        }
    }

    .contact-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(212, 175, 55, .1);
        color: var(--brand-secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        transition: transform .4s cubic-bezier(.175, .885, .32, 1.275), background-color .4s ease;
    }

    .contact-pane:hover .contact-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background: var(--brand-secondary);
        color: #fff;
    }

    .contact-region-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 1.55rem;
        color: var(--brand-primary);
    }

    .contact-details {
        font-size: 1.05rem;
        color: #555;
    }

    .contact-link {
        color: #555;
        transition: color .3s ease;
        text-decoration: none;
    }

    .contact-link:hover {
        color: var(--brand-secondary);
    }

    .shipping-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 18px;
        background: linear-gradient(135deg, var(--brand-secondary), #b8962e);
        color: #fff;
        border-radius: 30px;
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(212, 175, 55, .3);
    }

    /* ===================================================
       12. THE ROYAL GAZETTE (NEWSLETTER)
    =================================================== */
    .royal-gazette-box {
        background: radial-gradient(circle at 50% 50%, #451b47 0%, #2e102f 60%, #1a081b 100%);
        border: 1.5px solid rgba(212, 175, 55, 0.4);
        border-radius: 28px;
        padding: 55px 30px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(46, 16, 47, 0.3);
        color: #ffffff;
    }

    .gazette-badge {
        font-size: 0.74rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: var(--gold-primary);
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 12px;
    }

    .gazette-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 10px;
    }

    .gazette-sub {
        font-size: 0.98rem;
        color: rgba(255, 255, 255, 0.82);
        max-width: 580px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .gazette-input-wrap {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1.5px solid rgba(212, 175, 55, 0.4);
        border-radius: 50px;
        padding: 4px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .gazette-input-wrap:focus-within {
        border-color: var(--gold-primary);
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.35);
    }

    .gazette-input {
        background: transparent !important;
        border: none !important;
        color: #ffffff !important;
        padding: 12px 22px;
        font-size: 0.92rem;
        outline: none !important;
        box-shadow: none !important;
    }

    .gazette-input::placeholder {
        color: rgba(255, 255, 255, 0.55);
    }

    .btn-gazette-submit {
        background: linear-gradient(135deg, var(--gold-light), var(--gold-primary));
        color: #2e102f;
        border: none;
        border-radius: 50px;
        padding: 10px 24px;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .btn-gazette-submit:hover {
        background: #ffffff;
        color: #2e102f;
        transform: scale(1.03);
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
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        motionElements.forEach(el => motionObserver.observe(el));
    } else {
        // Fallback for older browsers
        motionElements.forEach(el => el.classList.add('motion-active'));
    }

    // ===================================================
    // 2. LIVE NUMERICAL STAT COUNTERS
    // ===================================================
    const counterElements = document.querySelectorAll('.counter-num');
    let countersStarted = false;

    function animateCounters() {
        if (countersStarted) return;
        countersStarted = true;

        counterElements.forEach(counter => {
            const isDecimal = counter.getAttribute('data-decimal') === 'true';
            const target = parseFloat(counter.getAttribute('data-target'));
            const duration = 2000;
            const stepTime = 20;
            const steps = duration / stepTime;
            const increment = target / steps;
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = isDecimal ? current.toFixed(1) : Math.floor(current).toLocaleString();
            }, stepTime);
        });
    }

    const heritageSection = document.getElementById('heritageStory');
    if (heritageSection && 'IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.25 });

        counterObserver.observe(heritageSection);
    } else {
        animateCounters();
    }

    // ===================================================
    // 3. INTERACTIVE 3D PERSPECTIVE TILT
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
    // 4. INTERACTIVE PRODUCT SPOTLIGHT TABS
    // ===================================================
    const tabButtons = document.querySelectorAll('[data-tab-target]');
    const productItems = document.querySelectorAll('.product-item-col');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            tabButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const target = this.getAttribute('data-tab-target');

            productItems.forEach((item, idx) => {
                let match = false;
                if (target === 'all') match = true;
                else if (target === 'featured' && item.classList.contains('tab-item-featured')) match = true;
                else if (target === 'new' && item.classList.contains('tab-item-new')) match = true;

                if (match) {
                    item.classList.remove('tab-hidden');
                    item.style.animation = `fadeCardIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) ${idx * 0.05}s forwards`;
                } else {
                    item.classList.add('tab-hidden');
                }
            });
        });
    });

    // ===================================================
    // 5. CURATED EDITORIAL FILTER PILLS
    // ===================================================
    const filterPills = document.querySelectorAll('[data-curated-filter]');
    const curatedItems = document.querySelectorAll('[data-curated-item]');

    filterPills.forEach(pill => {
        pill.addEventListener('click', function(e) {
            e.preventDefault();
            filterPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-curated-filter');

            curatedItems.forEach(item => {
                const itemId = item.getAttribute('data-curated-item');
                if (filterValue === 'all' || itemId === filterValue) {
                    item.classList.remove('curated-dimmed');
                } else {
                    item.classList.add('curated-dimmed');
                }
            });
        });
    });

    // ===================================================
    // 6. CUSTOMER FEEDBACK CAROUSEL ENGINE
    // ===================================================
    const fbTrack = document.getElementById('fbCarouselTrack');
    const fbPrevBtn = document.getElementById('fbPrevBtn');
    const fbNextBtn = document.getElementById('fbNextBtn');
    const fbDots = document.querySelectorAll('.fb-dot');

    if (fbTrack) {
        const getCardWidth = () => {
            const firstCard = fbTrack.querySelector('.fb-slide-card');
            return firstCard ? firstCard.getBoundingClientRect().width + 24 : 360;
        };

        const updateDots = () => {
            const scrollLeft = fbTrack.scrollLeft;
            const cardWidth = getCardWidth();
            const activeIndex = Math.min(Math.round(scrollLeft / cardWidth), fbDots.length - 1);
            fbDots.forEach((dot, idx) => {
                dot.classList.toggle('active', idx === activeIndex);
            });
        };

        if (fbNextBtn) {
            fbNextBtn.addEventListener('click', () => {
                fbTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
            });
        }

        if (fbPrevBtn) {
            fbPrevBtn.addEventListener('click', () => {
                fbTrack.scrollBy({ left: -getCardWidth(), behavior: 'smooth' });
            });
        }

        fbDots.forEach(dot => {
            dot.addEventListener('click', function() {
                const targetIndex = parseInt(this.getAttribute('data-dot-index'), 10);
                fbTrack.scrollTo({ left: targetIndex * getCardWidth(), behavior: 'smooth' });
            });
        });

        fbTrack.addEventListener('scroll', updateDots, { passive: true });

        // Auto-play with smooth pause on hover
        let fbAutoPlayTimer = setInterval(() => {
            const maxScroll = fbTrack.scrollWidth - fbTrack.clientWidth;
            if (fbTrack.scrollLeft >= maxScroll - 15) {
                fbTrack.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                fbTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
            }
        }, 5500);

        fbTrack.parentElement.addEventListener('mouseenter', () => clearInterval(fbAutoPlayTimer));
        fbTrack.parentElement.addEventListener('mouseleave', () => {
            clearInterval(fbAutoPlayTimer);
            fbAutoPlayTimer = setInterval(() => {
                const maxScroll = fbTrack.scrollWidth - fbTrack.clientWidth;
                if (fbTrack.scrollLeft >= maxScroll - 15) {
                    fbTrack.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    fbTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
                }
            }, 5500);
        });
    }

    // ===================================================
    // 7. MAGNETIC BUTTON EFFECT
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

// Wishlist Toast Handler with Micro-Animation
function handleWishlistAction(e, form) {
    // If not doing default submit, show instantaneous burst
    const btn = form.querySelector('.btn-wishlist');
    if (btn) {
        btn.classList.add('wishlist-saved');
        btn.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>';
    }
}

// Newsletter submission feedback
function handleNewsletterSubmit(e, form) {
    e.preventDefault();
    const btn = form.querySelector('.btn-gazette-submit');
    const input = form.querySelector('.gazette-input');
    const originalText = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-check-circle-fill text-gold me-1"></i> Welcome!';
    input.value = '';

    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }, 4000);
}
</script>
@endpush
