@extends('frontend.layouts.app')

@section('title', 'Shop | Luna Boutique')

@section('content')

<style>
    .shop-section {
        padding: 40px 0 80px;
        background: #fff;
    }

    .shop-breadcrumb {
        font-size: 13px;
        color: #999;
        margin-bottom: 25px;
    }

    .shop-breadcrumb a {
        color: #777;
        text-decoration: none;
    }

    .shop-heading {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        margin-bottom: 10px;
    }

    .shop-subtitle {
        color: #888;
        font-size: 14px;
    }

    .shop-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin: 35px 0;
        flex-wrap: wrap;
    }

    .shop-search {
        display: flex;
        max-width: 400px;
        width: 100%;
    }

    .shop-search input {
        border: 1px solid #ddd;
        border-radius: 0;
        padding: 12px 15px;
        font-size: 13px;
    }

    .shop-search button {
        background: #59663c;
        color: #fff;
        border: none;
        padding: 0 20px;
    }

    .shop-sort {
        width: 210px;
        border: 1px solid #ddd;
        border-radius: 0;
        padding: 12px;
        font-size: 13px;
    }

    /* Sidebar */

    .shop-sidebar {
        padding-right: 25px;
    }

    .sidebar-title {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-list li {
        margin-bottom: 14px;
    }

    .category-list a {
        text-decoration: none;
        color: #777;
        font-size: 14px;
        transition: .3s;
    }

    .category-list a:hover,
    .category-list a.active {
        color: #59663c;
        font-weight: 600;
    }

    .sidebar-divider {
        border-top: 1px solid #eee;
        margin: 25px 0;
    }

    /* Product Card */

    .shop-product-card {
        height: 100%;
        position: relative;
        background: #fff;
    }

    .shop-product-image-box {
        position: relative;
        overflow: hidden;
        background: #f7f6f2;
    }

    .shop-product-image {
        width: 100%;
        height: 310px;
        object-fit: cover;
        display: block;
        transition: transform .5s;
    }

    .shop-product-card:hover .shop-product-image {
        transform: scale(1.04);
    }

    .shop-wishlist {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 50%;
        background: #fff;
        color: #333;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }

    .shop-wishlist:hover {
        color: #59663c;
    }

    .shop-product-info {
        padding: 15px 0 25px;
    }

    .shop-product-category {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 7px;
    }

    .shop-product-name {
        color: #252525;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        display: block;
        margin-bottom: 8px;
    }

    .shop-product-name:hover {
        color: #59663c;
    }

    .shop-product-price {
        font-size: 15px;
        font-weight: 600;
        color: #59663c;
        margin-bottom: 12px;
    }

    .shop-old-price {
        font-size: 13px;
        color: #999;
        text-decoration: line-through;
        margin-left: 7px;
        font-weight: 400;
    }

    .shop-add-btn {
        display: block;
        width: 100%;
        padding: 11px 10px;
        background: #59663c;
        color: #fff;
        border: 1px solid #59663c;
        font-size: 11px;
        letter-spacing: 1px;
        transition: .3s;
    }

    .shop-add-btn:hover {
        background: #414c2b;
        color: #fff;
    }

    .shop-empty {
        background: #f7f6f2;
        padding: 60px 20px;
        text-align: center;
    }

    .shop-empty h4 {
        font-family: 'Playfair Display', serif;
    }

    .shop-pagination {
        margin-top: 35px;
    }

    .shop-pagination .page-link {
        color: #59663c;
        border-radius: 0;
    }

    .shop-pagination .active .page-link {
        background: #59663c;
        border-color: #59663c;
        color: #fff;
    }

    @media(max-width: 991px) {
        .shop-sidebar {
            padding-right: 10px;
        }

        .shop-product-image {
            height: 260px;
        }
    }

    @media(max-width: 767px) {
        .shop-heading {
            font-size: 32px;
        }

        .shop-sidebar {
            padding-right: 0;
            margin-bottom: 30px;
        }

        .shop-product-image {
            height: 230px;
        }

        .shop-toolbar {
            align-items: stretch;
        }

        .shop-search,
        .shop-sort {
            max-width: 100%;
            width: 100%;
        }
    }

    @media(max-width: 400px) {
        .shop-product-image {
            height: 180px;
        }
    }

</style>

<section class="shop-section">

    <div class="container">

        {{-- Breadcrumb --}}
        <div class="shop-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            /
            <span>Shop</span>
        </div>

        {{-- Heading --}}
        <div class="text-center">

            <h1 class="shop-heading">
                Shop All
            </h1>

            <p class="shop-subtitle">
                Discover pieces you'll love.
            </p>

        </div>

        {{-- Search & Sort --}}
        <form action="{{ route('shop') }}" method="GET">

            <div class="shop-toolbar">

                <div class="shop-search">

                    <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">

                    {{-- Preserve selected category --}}
                    @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <button type="submit">
                        Search
                    </button>

                </div>

                <select name="sort" class="form-select shop-sort" onchange="this.form.submit()">

                    <option value="">Sort By: Default</option>

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
                        Name: A to Z
                    </option>

                </select>

            </div>

        </form>

        <div class="row">

            {{-- Category Sidebar --}}
            <div class="col-lg-3 col-md-4">

                <div class="shop-sidebar">

                    <h4 class="sidebar-title">
                        Categories
                    </h4>

                    <ul class="category-list">

                        <li>
                            <a href="{{ route('shop') }}" class="{{ !request('category') ? 'active' : '' }}">

                                All Products

                            </a>
                        </li>

                        @foreach($categories as $category)

                        <li>

                            <a href="{{ route('shop', array_merge(request()->except('page'), ['category' => $category->slug])) }}" class="{{ request('category') == $category->slug ? 'active' : '' }}">

                                {{ $category->name }}

                            </a>

                        </li>

                        @endforeach

                    </ul>

                    <div class="sidebar-divider"></div>

                    <a href="{{ route('shop') }}" class="text-muted small text-decoration-none">

                        Clear All Filters

                    </a>

                </div>

            </div>

            {{-- Products --}}
            <div class="col-lg-9 col-md-8">

                {{-- Result Count --}}
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <span class="text-muted small">
                        Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
                        of {{ $products->total() }} products
                    </span>

                </div>

                @if($products->count() > 0)

                <div class="row g-4">

                    @foreach($products as $product)

                    <div class="col-6 col-lg-4">

                        <div class="shop-product-card">

                            {{-- Product Image --}}
                            <div class="shop-product-image-box">

                                <a href="{{ route('product.details', $product->slug) }}">

                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="shop-product-image">

                                </a>

                                {{-- Wishlist --}}
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">

                                    @csrf

                                    <button type="submit" class="shop-wishlist" title="Add to Wishlist">

                                        ♡

                                    </button>

                                </form>

                            </div>

                            {{-- Product Info --}}
                            <div class="shop-product-info">

                                <div class="shop-product-category">

                                    {{ $product->category->name ?? 'Collection' }}

                                </div>

                                <a href="{{ route('product.details', $product->slug) }}" class="shop-product-name">

                                    {{ $product->name }}

                                </a>

                                {{-- Price --}}
                                <div class="shop-product-price">

                                    ₹{{ number_format($product->sale_price ?? $product->price, 2) }}

                                    @if($product->sale_price && $product->sale_price < $product->price)

                                        <span class="shop-old-price">

                                            ₹{{ number_format($product->price, 2) }}

                                        </span>

                                        @endif

                                </div>

                                {{-- Add to Bag --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">

                                    @csrf

                                    <input type="hidden" name="quantity" value="1">

                                    <button type="submit" class="shop-add-btn">

                                        ADD TO BAG +

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                {{-- Pagination --}}
                <div class="shop-pagination">

                    {{ $products->links() }}

                </div>

                @else

                <div class="shop-empty">

                    <h4>No Products Found</h4>

                    <p class="text-muted mt-2">
                        We couldn't find products matching your selection.
                    </p>

                    <a href="{{ route('shop') }}" class="btn btn-dark mt-3">

                        VIEW ALL PRODUCTS

                    </a>

                </div>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection
