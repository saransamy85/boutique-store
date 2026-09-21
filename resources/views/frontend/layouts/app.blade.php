<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Kathirazhaki Boutique | Effortless Style')</title>

    <meta name="description" content="@yield('meta_description', 'Discover timeless fashion and effortless everyday style at Luna Boutique.')">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #003B32;
            --brand-secondary: #D4AF37;
            --brand-background: #FAF8F1;
            --brand-text: #242424;
            --brand-accent: #C2185B;
            --brand-border: #E8E2D3;

            --luna-olive: var(--brand-primary);
            --luna-border: var(--brand-border);
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
            background: #fff;
            border-bottom: 1px solid var(--luna-border);
            padding: 12px 0;
        }

        .luna-logo {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            line-height: 1;
            letter-spacing: 5px;
            font-weight: 500;
            color: #25271f;
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
            color: #303128;
            padding: 10px 0;
            white-space: nowrap;
        }

        .luna-nav-links .nav-link:hover {
            color: var(--luna-olive);
        }

        .luna-icons {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .luna-icons a {
            font-size: 18px;
            position: relative;
            color: #292b23;
        }

        .luna-icons a:hover {
            color: var(--luna-olive);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--luna-olive);
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
            background: var(--luna-olive);
            color: #fff;
            border: 1px solid var(--luna-olive);
            border-radius: 0;
            padding: 12px 22px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .btn-luna:hover {
            background: #41492a;
            border-color: #41492a;
            color: #fff;
        }

        .btn-luna-outline {
            border: 1px solid #55594a;
            color: #303128;
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
            background: #f6f5f0;
            border-top: 1px solid var(--luna-border);
            padding: 45px 0 20px;
        }

        .luna-footer h6 {
            font-family: 'DM Sans', sans-serif;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .luna-footer a {
            display: block;
            font-size: 12px;
            color: #66675f;
            margin-bottom: 10px;
        }

        .luna-footer a:hover {
            color: var(--luna-olive);
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
   LUNA BOUTIQUE HOMEPAGE
=================================== */

        /* Hero Section */

        .luna-hero {
            min-height: 420px;
            background-color: #f4f1e9;
            background-image:
                url('https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=1800&q=85');
            background-size: cover;
            background-position: center 35%;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
        }

        .luna-hero-content {
            max-width: 480px;
            padding: 60px 0;
        }

        .luna-hero-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--luna-olive);
            text-transform: uppercase;
        }

        .luna-hero h1 {
            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.05;
            font-weight: 500;
            margin: 18px 0;
            color: #24251f;
            letter-spacing: -1.5px;
        }

        .luna-hero p {
            font-size: 14px;
            line-height: 1.8;
            color: #55564e;
            max-width: 350px;
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
        }

        .luna-product-img-wrap {
            position: relative;
            overflow: hidden;
            background: #f3f0e9;
        }

        .luna-product-img {
            width: 100%;
            height: 270px;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .luna-product-card:hover .luna-product-img {
            transform: scale(1.05);
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
                min-height: 400px;
                background-position: 62% center;
            }

            .luna-hero-content {
                padding: 45px 15px;
                max-width: 65%;
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

</body>
</html>
