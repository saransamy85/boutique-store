<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Kathirazhagi Boutique | Effortless Style')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">

    <meta name="description" content="@yield('meta_description', 'Discover timeless fashion and effortless everyday style at Kathirazhagi Boutique.')">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #2e102f;
            /* Deep Purple from Logo */
            --brand-secondary: #d4af37;
            /* Gold from Logo */
            --brand-background: #FAF8F1;
            --brand-text: #242424;
            --brand-accent: #8b4b7c;
            /* Light Purple from Logo */
            --brand-border: #d4af37;

            --luna-olive: var(--brand-secondary);
            --luna-border: var(--brand-secondary);
            --luna-muted: #6c757d;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--brand-text);
            background: #fff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Playfair Display', serif;
        }

        /* Primary Button */
        .btn-brand {
            background: var(--brand-primary);
            color: var(--brand-secondary);
            border: 1px solid var(--brand-primary);
            padding: 12px 24px;
            transition: 0.3s ease;
        }

        .container {
            max-width: 1440px;
        }

        /* Navbar */

        .luna-navbar {
            min-height: 76px;
            background: var(--brand-primary);
            border-bottom: 2px solid var(--brand-secondary);
            padding: 12px 0;
        }

        .luna-logo {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            line-height: 1;
            letter-spacing: 5px;
            font-weight: 500;
            color: var(--brand-secondary);
        }

        .luna-logo small {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 9px;
            letter-spacing: 5px;
            text-align: center;
            margin-top: 5px;
        }

        .luna-nav-links {
            gap: 22px;
        }

        .luna-nav-links .nav-link {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #fff;
            padding: 10px 0;
            white-space: nowrap;
        }

        .luna-nav-links .nav-link:hover {
            color: var(--brand-secondary);
        }

        .luna-icons {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .luna-icons a {
            font-size: 18px;
            position: relative;
            color: #fff;
        }

        .luna-icons a:hover {
            color: var(--brand-secondary);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--brand-accent);
            color: #fff;
            font-size: 9px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Common buttons */

        .btn-luna {
            background: var(--brand-primary);
            color: var(--brand-secondary);
            border: 1px solid var(--brand-secondary);
            border-radius: 0;
            padding: 12px 22px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .btn-luna:hover {
            background: var(--brand-secondary);
            border-color: var(--brand-secondary);
            color: var(--brand-primary);
        }

        .btn-luna-outline {
            border: 1px solid #4a3b49;
            color: #2e102f;
            border-radius: 0;
            padding: 12px 22px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .btn-luna-outline:hover {
            background: var(--luna-olive);
            color: #fff;
        }

        /* Section headings */

        .luna-section-title {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .luna-section-subtitle {
            font-size: 13px;
            color: var(--luna-muted);
        }

        /* Footer */

        .luna-footer {
            background-color: var(--brand-primary);
            background-image: linear-gradient(to right, rgba(46, 16, 47, 0.95) 0%, rgba(46, 16, 47, 0.75) 100%),
            url('{{ asset("frontend/images/hero-bg2.png") }}');
            background-size: cover;
            background-position: center;
            border-top: 2px solid var(--brand-secondary);
            padding: 45px 0 20px;
            color: #fff;
        }

        .luna-footer h6 {
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 18px;
            color: var(--brand-secondary);
        }

        .luna-footer p,
        .luna-footer .text-muted {
            color: #ddd !important;
        }

        .luna-footer a {
            display: block;
            font-size: 12px;
            color: #ddd;
            margin-bottom: 10px;
        }

        .luna-footer a:hover {
            color: var(--brand-secondary);
        }

        /* Mobile */

        @media(max-width: 991px) {
            .luna-navbar .navbar-collapse {
                padding: 20px 0;
            }

            .luna-nav-links {
                gap: 5px;
                align-items: flex-start !important;
            }

            .luna-icons {
                margin-top: 15px;
            }

            .luna-logo {
                font-size: 27px;
            }
        }

        /* ===================================
   KATHIRAZHAGI BOUTIQUE HOMEPAGE
=================================== */

        /* Hero Section */

        .luna-hero {
            min-height: 450px;
            background-color: var(--brand-primary);
            background-image: linear-gradient(to right, rgba(46, 16, 47, 0.95) 0%, rgba(46, 16, 47, 0.4) 100%),
            url('{{ asset("frontend/images/hero-bg1.jpg") }}');
            background-size: cover;
            background-position: center 10%;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
        }

        .luna-hero-content {
            max-width: 480px;
            padding: 60px 0;
            position: relative;
            z-index: 2;
        }

        .luna-hero-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--brand-secondary);
            text-transform: uppercase;
        }

        .luna-hero h1 {
            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.05;
            font-weight: 500;
            margin: 18px 0;
            color: #fff;
            letter-spacing: -1.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .luna-hero p {
            font-size: 14px;
            line-height: 1.8;
            color: #e8e8e8;
            max-width: 350px;
            text-shadow: 0 1px 8px rgba(0, 0, 0, 0.5);
        }

        /* Benefits Bar */

        .luna-benefits {
            border-bottom: 1px solid var(--luna-border);
            background: #fff;
        }

        .luna-benefit-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 22px 10px;
        }

        .luna-benefit-item i {
            font-size: 22px;
            color: var(--luna-olive);
        }

        .luna-benefit-item h6 {
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 5px;
        }

        .luna-benefit-item p {
            font-size: 10px;
            color: var(--luna-muted);
            margin: 0;
        }

        /* Section Heading */

        .luna-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .luna-heading h2 {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .luna-heading span {
            display: block;
            width: 35px;
            height: 2px;
            background: var(--luna-olive);
            margin: 12px auto 0;
        }

        /* New Arrivals */

        .luna-new-arrivals {
            padding: 45px 0 55px;
        }

        .luna-product-card {
            height: 100%;
            border: none;
            background: transparent;
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .luna-product-card:hover {
            transform: translateY(-8px);
        }

        .luna-product-img-wrap {
            position: relative;
            overflow: hidden;
            background: #f3f0e9;
            border-radius: 8px;
            transition: box-shadow 0.4s ease, border-radius 0.4s ease;
        }

        .luna-product-card:hover .luna-product-img-wrap {
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .luna-product-img {
            width: 100%;
            height: 270px;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .luna-product-card:hover .luna-product-img {
            transform: scale(1.08);
        }

        .luna-product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #fff;
            color: #333;
            padding: 5px 9px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .offer-badge-red {
            position: absolute;
            top: 0px;
            left: 0px;
            background: #ff0000;
            color: #fff;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 2;
        }

        .discount-text-red {
            color: #ff0000;
            font-size: 11px;
            font-weight: 600;
            margin-left: 5px;
        }

        .luna-product-info {
            padding: 12px 2px;
        }

        .luna-product-name {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 600;
            color: #303128;
            margin-bottom: 5px;
        }

        .luna-product-price {
            font-size: 12px;
            font-weight: 600;
        }

        .luna-product-old-price {
            color: #999;
            font-size: 11px;
            text-decoration: line-through;
            margin-left: 5px;
        }

        .luna-product-colors {
            display: flex;
            gap: 6px;
            margin-top: 9px;
        }

        .luna-color-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            border: 1px solid #ddd;
        }

        /* Promotional Banners */

        .luna-promo {
            min-height: 250px;
            display: flex;
            align-items: center;
            padding: 30px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .luna-promo-summer {
            background-color: #e8e1d7;
            background-image: url('https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1000&q=85');
        }

        .luna-promo-accessories {
            background-color: #e9e5dc;
            background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1000&q=85');
        }

        .luna-promo-content {
            position: relative;
            z-index: 1;
            max-width: 220px;
            background: rgba(255, 255, 255, .88);
            padding: 22px;
        }

        .luna-promo-content h3 {
            font-size: 25px;
            line-height: 1.2;
            margin: 10px 0;
        }

        .luna-promo-content p {
            font-size: 11px;
            color: #666;
        }

        .luna-text-link {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--luna-olive);
            border-bottom: 1px solid var(--luna-olive);
            padding-bottom: 4px;
        }

        /* Rewards */

        .luna-rewards {
            background: #f4f3ed;
            margin-top: 45px;
        }

        .luna-reward-item {
            padding: 24px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .luna-reward-item i {
            font-size: 24px;
            color: var(--luna-olive);
        }

        .luna-reward-item h6 {
            font-family: 'DM Sans', sans-serif;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .luna-reward-item p {
            font-size: 10px;
            color: #777;
            margin: 0;
        }

        /* Newsletter */

        .luna-newsletter {
            background: #f4f1e9;
            padding: 35px 20px;
            text-align: center;
        }

        .luna-newsletter h3 {
            font-size: 25px;
        }

        .luna-newsletter p {
            font-size: 12px;
            color: #777;
        }

        .luna-newsletter .form-control {
            border-radius: 0;
            font-size: 12px;
            min-height: 42px;
        }

        @media(min-width: 1200px) {
            .luna-product-img {
                height: 300px;
            }
        }

        @media(max-width: 767px) {
            .luna-hero {
                min-height: 420px;
                background-position: center 15%;
                padding-top: 0;
            }

            .luna-hero-content {
                padding: 45px 15px;
                max-width: 85%;
                text-align: left;
            }

            .luna-hero h1 {
                font-size: 34px;
            }

            .luna-hero p {
                font-size: 12px;
            }

            .luna-benefit-item {
                justify-content: flex-start;
                padding: 15px 5px;
            }

            .luna-product-img {
                height: 220px;
            }

            .luna-promo {
                min-height: 230px;
                padding: 15px;
            }

            .luna-promo-content {
                max-width: 180px;
                padding: 15px;
            }

            .luna-promo-content h3 {
                font-size: 20px;
            }
        }

        @media(max-width: 400px) {
            .luna-hero-content {
                max-width: 75%;
            }

            .luna-hero h1 {
                font-size: 29px;
            }

            .luna-product-img {
                height: 190px;
            }
        }

        /* Floating Action Buttons */
        .floating-action-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 1000;
        }

        .floating-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 26px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
            position: relative;
        }

        .floating-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .whatsapp-btn {
            background-color: #25D366;
        }

        .whatsapp-btn:hover {
            background-color: #1ebe58;
        }

        .whatsapp-btn::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid #25D366;
            animation: pulse-ring 2s infinite;
            top: 0;
            left: 0;
            box-sizing: border-box;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }

        .scroll-to-top {
            background-color: var(--brand-secondary, #d4af37);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            width: 45px;
            height: 45px;
            font-size: 20px;
            margin-left: auto;
            /* align to right with WhatsApp btn */
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .scroll-to-top:hover {
            background-color: #b8962e;
        }

    </style>

    @stack('styles')
</head>

<body>

    {{-- Navbar --}}
    @include('frontend.partials.navbar')

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('frontend.partials.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

    {{-- Floating Action Buttons --}}
    <div class="floating-action-buttons">
        <button id="scrollToTopBtn" class="floating-btn scroll-to-top" title="Go to top">
            <i class="bi bi-arrow-up"></i>
        </button>
        <a href="https://wa.me/+918072000915" target="_blank" class="floating-btn whatsapp-btn" title="Chat on WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <script>
        // Scroll to top functionality
        document.addEventListener('DOMContentLoaded', function() {
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");

            window.addEventListener("scroll", function() {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.add("show");
                } else {
                    scrollToTopBtn.classList.remove("show");
                }
            });

            scrollToTopBtn.addEventListener("click", function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0
                    , behavior: "smooth"
                });
            });
        });

    </script>

</body>
</html>
