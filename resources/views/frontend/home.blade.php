@extends('frontend.layouts.app')

@php
// ---- Change the brand name in ONE place ----
$brand = 'Kathirazhagi Boutique';
$brandShort = 'Kathirazhagi';

// Join / review links fall back safely if the routes don't exist yet
$joinUrl = Route::has('register') ? route('register') : route('shop');

// Curated collections (edit images/links here, no need to touch the markup)
$collections = [
    [
        'id' => 'festive-silk',
        'badge' => "Stylist's Choice",
        'tag' => 'Heritage Silk & Sarees',
        'title' => 'The Royal Festive Edit',
        'desc' => 'Opulent pure silk weaves, ornate golden zari borders, and majestic pallus crafted for weddings and temple celebrations.',
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
        'desc' => 'Featherlight fabrics and delicate floral embroideries designed for effortless day-to-evening allure.',
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
        'desc' => 'Voluminous flared hemlines, deep jewel tones, and sparkling sequin embellishments for celebrated evenings.',
        'cta' => 'Discover Gowns Edit',
        'url' => route('shop', ['category' => 'spacesilk-gown']),
        'image' => asset('frontend/images/curated-fusion-gowns.jpg'),
        'price_from' => 'From ₹1,299',
        'tags' => ['Statement Flairs', 'Hand Sequinned'],
        'featured' => false,
    ],
];

// Customer feedback (replace with a Review model later: Review::latest()->take(6)->get())
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

@section('title', $brand . ' | Effortless Style. Every Day.')
@section('meta_description', 'Discover timeless sarees, elegant clothing, new arrivals and accessories at ' . $brand . '.')

@section('content')

{{-- ==========================================
    1. HERO BANNER
========================================== --}}
<section class="luna-hero">
    <div class="container">
        <div class="luna-hero-content">
            <span class="luna-hero-label">New Season, New You</span>

            <h1>Effortless Style.<br>Every Day.</h1>

            <p>Timeless pieces designed to make you look and feel your best.</p>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="{{ route('shop', ['sort' => 'latest']) }}" class="btn btn-luna">Shop New Arrivals</a>
                <a href="{{ route('shop', ['category' => 'sarees']) }}" class="btn btn-luna-outline" style="border-color:#fff;color:#fff;">Shop Sarees</a>
            </div>
        </div>
    </div>
</section>

{{-- ==========================================
    2. SHOP BY CATEGORY (REDESIGNED)
========================================== --}}
<section class="boutique-categories-section py-5 position-relative">
    <div class="container position-relative z-1">
        {{-- Luxury Section Header --}}
        <div class="row align-items-end mb-4 mb-lg-5 g-3">
            <div class="col-lg-8">
                <div class="cat-eyebrow-badge mb-2">
                    <i class="bi bi-stars"></i>
                    <span>Curated Silhouettes</span>
                </div>
                <h2 class="cat-main-title mb-2">Shop by Category</h2>
                <p class="cat-sub-title mb-0">Explore signature weaves, artisanal designs, and graceful ensembles crafted for every occasion.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('shop') }}" class="btn-cat-view-all">
                    <span>Explore All</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Categories Showcase Grid --}}
        <div class="boutique-cat-grid">
            @forelse($categories as $category)
            <div class="boutique-cat-card-wrapper">
                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="boutique-cat-card" title="Shop {{ $category->name }}">
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
                                <span class="cat-cta-text">Shop Now</span>
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

{{-- ==========================================
    3. SHOPPING BENEFITS
========================================== --}}
<section class="luna-benefits">
    <div class="container">
        <div class="row">
            @foreach([
            ['bi-truck', 'Free Shipping', 'On orders over ₹999'],
            ['bi-arrow-repeat', 'Easy Returns', '7-day hassle-free returns'],
            ['bi-heart', 'Long Lasting', 'Fashion made for you'],
            ['bi-lock', 'Secure Checkout', 'Safe & trusted payments'],
            ] as [$icon, $title, $text])
            <div class="col-6 col-lg-3">
                <div class="luna-benefit-item">
                    <i class="bi {{ $icon }}"></i>
                    <div>
                        <h6>{{ $title }}</h6>
                        <p>{{ $text }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ==========================================
    4. NEW ARRIVALS
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
            @php
            $onSale = $product->sale_price !== null && $product->sale_price < $product->price;
                $discount = $onSale ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
                @endphp

                <div class="col">
                    <div class="luna-product-card">

                        <a href="{{ route('product.details', $product->slug) }}">
                            <div class="luna-product-img-wrap">
                                @if($onSale)
                                <span class="offer-badge-red">Extra {{ $discount }}% OFF</span>
                                @else
                                <span class="luna-product-badge">New</span>
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

                        <div class="luna-product-info">
                            <a href="{{ route('product.details', $product->slug) }}" class="luna-product-name d-block">
                                {{ $product->name }}
                            </a>

                            <div class="luna-product-price">
                                ₹{{ number_format((float) ($product->sale_price ?? $product->price), 2) }}
                                @if($onSale)
                                <span class="luna-product-old-price">₹{{ number_format((float) $product->price, 2) }}</span>
                                <span class="discount-text-red">{{ $discount }}% OFF</span>
                                @endif
                            </div>

                            {{-- Decorative only: replace with real colour variants when available --}}
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
                    <p class="text-muted">New arrivals will be available soon.</p>
                    <a href="{{ route('shop') }}" class="btn btn-luna">Explore Shop</a>
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
    5. CURATED SIGNATURE COLLECTIONS (REDESIGNED)
========================================== --}}
<section class="curated-section py-5 position-relative" id="curated-collections">
    <div class="container position-relative z-1">
        {{-- Section Header with Interactive Filter Pills --}}
        <div class="d-flex flex-column align-items-center text-center mb-4 mb-lg-5">
            <div class="cat-eyebrow-badge mb-2">
                <i class="bi bi-stars"></i>
                <span>Exclusive Editorial Edits</span>
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
            <div class="curated-hero-col" data-curated-item="{{ $featuredCol['id'] }}">
                <a href="{{ $featuredCol['url'] }}" class="curated-card-hero">
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
                            <span class="lookbook-tag">
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
            <div class="curated-stack-col">
                @foreach($otherCols as $col)
                <div class="curated-sub-item" data-curated-item="{{ $col['id'] }}">
                    <a href="{{ $col['url'] }}" class="curated-card-sub">
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

{{-- ==========================================
    6. REWARDS
========================================== --}}
<section class="py-5 my-5" style="background:#faf9f7;">
    <div class="container">
        <div class="rewards-wrapper p-4 p-md-5 rounded-4 position-relative overflow-hidden">
            <div class="rewards-bg-glow"></div>

            <div class="row align-items-center position-relative z-1 g-4 text-center text-md-start">
                <div class="col-12 col-lg-3 mb-2 mb-lg-0 border-end-lg">
                    <h3 class="text-white fw-bold mb-2" style="font-size:2rem;">
                        {{ $brandShort }}<br><span style="color:var(--brand-secondary);">Rewards</span>
                    </h3>
                    <p class="text-white-50 mb-0">Experience fashion with exclusive perks.</p>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="row g-4">
                        @foreach([
                        ['bi-gift-fill', 'Join Rewards', 'Earn points, unlock perks and special member offers.', 'Join Now', $joinUrl],
                        ['bi-envelope-paper-heart-fill','Get 10% Off', 'Sign up for our newsletter to get instant discount.', 'Sign Up Now', '#luna-newsletter'],
                        ['bi-stars', 'Love ' . $brandShort, 'Find a timeless style that feels uniquely like you.', 'Explore More', route('shop')],
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

{{-- ==========================================
    7. CONTACT
========================================== --}}
<section class="container py-5 mb-5" id="contact-us">
    <div class="luna-heading text-center mb-5">
        <h2>Get in Touch</h2>
        <span></span>
    </div>

    <div class="contact-showcase shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-6 p-5 contact-pane bg-white">
                <div class="contact-icon-wrapper mb-4"><i class="bi bi-geo-alt-fill"></i></div>
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

            <div class="col-md-6 p-5 contact-pane contact-pane-alt">
                <div class="contact-icon-wrapper mb-4"><i class="bi bi-globe-americas"></i></div>
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
                <div class="shipping-badge"><i class="bi bi-airplane me-2"></i> International Shipping Available</div>
            </div>
        </div>
    </div>
</section>

{{-- ==========================================
    8. CUSTOMER STORIES & FEEDBACK CAROUSEL (REDESIGNED)
========================================== --}}
<section class="feedback-carousel-section py-5 position-relative" id="customer-feedback">
    <div class="container position-relative z-1">
        {{-- Header with Navigation Controls --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 mb-lg-5 pb-2">
            <div>
                <div class="cat-eyebrow-badge mb-2">
                    <i class="bi bi-chat-heart-fill"></i>
                    <span>Loved by 5,000+ Patrons</span>
                </div>
                <h2 class="curated-section-heading mb-1">Customer Stories & Feedback</h2>
                <p class="curated-section-sub mb-0">
                    Real words from patrons celebrating life's most precious occasions in Kathirazhagi designs.
                </p>
            </div>
            <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
                <button type="button" class="fb-carousel-nav-btn" id="fbPrevBtn" aria-label="Previous review">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="fb-carousel-nav-btn" id="fbNextBtn" aria-label="Next review">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        {{-- Carousel Container --}}
        <div class="fb-carousel-wrapper position-relative">
            <div class="fb-carousel-track" id="fbCarouselTrack">
                @foreach($reviews as $index => $review)
                <div class="fb-slide-card" data-slide-index="{{ $index }}">
                    <div class="fb-card-inner">
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

{{-- ==========================================
    9. NEWSLETTER
========================================== --}}
<section class="container py-4" id="luna-newsletter">
    <div class="luna-newsletter">
        <h3>Let's Be Friends</h3>
        <p>Get the latest styles, new arrivals and exclusive offers.</p>

        <form class="mx-auto mt-3" style="max-width:420px" onsubmit="return false;">
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email address" disabled>
                <button type="button" class="btn btn-luna" disabled>Subscribe</button>
            </div>
            <small class="text-muted d-block mt-2">Newsletter signup will be enabled in a later step.</small>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
                    item.classList.add('curated-highlight');
                } else {
                    item.classList.add('curated-dimmed');
                    item.classList.remove('curated-highlight');
                }
            });

            setTimeout(() => {
                curatedItems.forEach(i => i.classList.remove('curated-highlight'));
            }, 600);
        });
    });

    // Customer Feedback Carousel
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

        // Auto-play with pause on hover
        let fbAutoPlayTimer = setInterval(() => {
            const maxScroll = fbTrack.scrollWidth - fbTrack.clientWidth;
            if (fbTrack.scrollLeft >= maxScroll - 10) {
                fbTrack.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                fbTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
            }
        }, 5000);

        fbTrack.parentElement.addEventListener('mouseenter', () => clearInterval(fbAutoPlayTimer));
        fbTrack.parentElement.addEventListener('mouseleave', () => {
            clearInterval(fbAutoPlayTimer);
            fbAutoPlayTimer = setInterval(() => {
                const maxScroll = fbTrack.scrollWidth - fbTrack.clientWidth;
                if (fbTrack.scrollLeft >= maxScroll - 10) {
                    fbTrack.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    fbTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
                }
            }, 5000);
        });
    }
});
</script>

@endsection

@push('styles')
<style>
    /* ==========================================
       SHOP BY CATEGORY - LUXURY REDESIGN
    ========================================== */
    .boutique-categories-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
        padding: 60px 0 70px;
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

    .cat-main-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--brand-primary);
        letter-spacing: -0.3px;
    }

    .cat-sub-title {
        font-size: 0.95rem;
        color: #666;
        max-width: 540px;
        line-height: 1.5;
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
    }

    .btn-cat-view-all i {
        font-size: 0.85rem;
        transition: transform 0.3s ease;
    }

    .btn-cat-view-all:hover {
        background: var(--brand-primary);
        color: #fff;
        border-color: var(--brand-primary);
        box-shadow: 0 8px 20px rgba(46, 16, 47, 0.2);
        transform: translateY(-2px);
    }

    .btn-cat-view-all:hover i {
        transform: translateX(4px);
    }

    /* Category Showcase Grid */
    .boutique-cat-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-top: 10px;
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

        .cat-content {
            padding: 14px 12px;
        }

        .cat-name {
            font-size: 1.1rem;
        }
    }

    /* Card Item */
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
    }

    .boutique-cat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(46, 16, 47, 0.18), 0 0 0 1.5px rgba(212, 175, 55, 0.7);
    }

    /* Media Box */
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

    /* Overlay Gradient */
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

    /* Floating Count Badge */
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

    /* Decorative Gold Inner Frame */
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

    /* Content Area */
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
        transition: color 0.3s ease;
    }

    .cat-cta-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        transition: border-color 0.3s ease;
    }

    .cat-cta-text {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.88);
        transition: color 0.3s ease;
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

    .boutique-cat-card:hover .cat-cta-text {
        color: #ffffff;
    }

    .boutique-cat-card:hover .cat-cta-bar {
        border-color: rgba(212, 175, 55, 0.5);
    }

    .boutique-cat-card:hover .cat-cta-circle {
        background: var(--brand-secondary);
        color: var(--brand-primary);
        border-color: var(--brand-secondary);
        transform: translateX(4px);
    }

    /* ==========================================
       CURATED SIGNATURE COLLECTIONS - REDESIGN
    ========================================== */
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
        box-shadow: 0 8px 18px rgba(46, 16, 47, 0.1);
    }

    .curated-filter-pill.active {
        background: var(--brand-primary);
        color: #ffffff;
        border-color: var(--brand-primary);
        box-shadow: 0 8px 22px rgba(46, 16, 47, 0.25);
    }

    /* Asymmetric Editorial Grid */
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

    /* Card Box & Media */
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

    /* Dark Luxury Overlay */
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

    .curated-card-hero:hover .curated-overlay-dark,
    .curated-card-sub:hover .curated-overlay-dark {
        background: linear-gradient(
            180deg,
            rgba(46, 16, 47, 0.25) 0%,
            rgba(46, 16, 47, 0.42) 35%,
            rgba(46, 16, 47, 0.92) 75%,
            rgba(46, 16, 47, 0.98) 100%
        );
    }

    /* Gold Sheen Frame */
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

    /* Top Meta */
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
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Lookbook Tags (Hero Card) */
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
        letter-spacing: 0.4px;
        width: fit-content;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .curated-card-hero:hover .lookbook-tag {
        background: rgba(255, 255, 255, 0.28);
        transform: translateX(4px);
    }

    .lookbook-tag i {
        color: var(--brand-secondary);
    }

    /* Content on Hero */
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
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
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
        background: linear-gradient(135deg, #e5c358, var(--brand-secondary));
    }

    .curated-ready-hint {
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 600;
    }

    .curated-ready-hint i {
        color: var(--brand-secondary);
    }

    /* Sub Cards Content */
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
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
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

    /* Filter Animations */
    .curated-dimmed {
        opacity: 0.25 !important;
        filter: grayscale(80%) !important;
        transform: scale(0.97) !important;
        transition: all 0.4s ease !important;
    }

    .curated-highlight {
        animation: curatedPulse 0.6s ease;
    }

    @keyframes curatedPulse {
        0% { transform: scale(0.98); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }

    /* Rewards */
    .rewards-wrapper {
        background: var(--brand-primary);
        box-shadow: 0 25px 50px -12px rgba(46, 16, 47, .4)
    }

    @media(min-width:992px) {
        .border-end-lg {
            border-right: 1px solid rgba(255, 255, 255, .1)
        }
    }

    .rewards-bg-glow {
        position: absolute;
        top: -50%;
        left: -20%;
        width: 140%;
        height: 200%;
        background: radial-gradient(circle at 80% 20%, rgba(212, 175, 55, .15), transparent 40%), radial-gradient(circle at 20% 80%, rgba(212, 175, 55, .1), transparent 40%);
        pointer-events: none
    }

    .reward-feature-card {
        padding: 20px;
        border-radius: 12px;
        height: 100%;
        background: rgba(255, 255, 255, .03);
        border: 1px solid rgba(255, 255, 255, .05);
        transition: transform .3s ease, background .3s ease, border-color .3s ease
    }

    .reward-feature-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, .06);
        border-color: rgba(212, 175, 55, .3)
    }

    .reward-icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(212, 175, 55, .2), rgba(212, 175, 55, .05));
        color: var(--brand-secondary);
        font-size: 1.5rem;
        margin-bottom: 20px;
        border: 1px solid rgba(212, 175, 55, .2)
    }

    .reward-link {
        color: var(--brand-secondary);
        font-size: .85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-flex;
        align-items: center;
        transition: color .3s ease
    }

    .reward-link i {
        font-size: .75rem;
        margin-left: 5px;
        transition: margin-left .3s ease
    }

    .reward-link:hover {
        color: #fff
    }

    .reward-link:hover i {
        margin-left: 10px
    }

    /* Contact */
    .contact-showcase {
        border: 1px solid rgba(0, 0, 0, .05);
        transition: box-shadow .4s ease
    }

    .contact-showcase:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, .12) !important
    }

    .contact-pane {
        transition: background-color .4s ease
    }

    .contact-pane-alt {
        background: #f8f9fa
    }

    .contact-pane:hover {
        background: #fff
    }

    @media(min-width:768px) {
        .contact-pane-alt {
            border-left: 1px solid rgba(0, 0, 0, .08)
        }
    }

    @media(max-width:767px) {
        .contact-pane-alt {
            border-top: 1px solid rgba(0, 0, 0, .08)
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
        transition: transform .4s cubic-bezier(.175, .885, .32, 1.275), background-color .4s ease
    }

    .contact-pane:hover .contact-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background: var(--brand-secondary);
        color: #fff
    }

    .contact-region-title {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--brand-primary)
    }

    .contact-details {
        font-size: 1.05rem;
        color: #555
    }

    .contact-link {
        color: #555;
        transition: color .3s ease
    }

    .contact-link:hover {
        color: var(--brand-secondary)
    }

    .shipping-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: linear-gradient(135deg, var(--brand-secondary), #b8962e);
        color: #fff;
        border-radius: 30px;
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(212, 175, 55, .3)
    }

    /* ==========================================
       CUSTOMER FEEDBACK CAROUSEL - LUXURY REDESIGN
    ========================================== */
    .feedback-carousel-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 50%, #FFFFFF 100%);
        padding: 70px 0 85px;
        overflow: hidden;
    }

    .fb-carousel-nav-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #ffffff;
        color: var(--brand-primary);
        border: 1.5px solid rgba(46, 16, 47, 0.15);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
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

    /* Dots */
    .fb-carousel-dots {
        margin-top: 20px;
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

</style>
@endpush
