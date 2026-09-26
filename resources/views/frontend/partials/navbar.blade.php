<nav class="navbar navbar-expand-lg luna-navbar sticky-top">

    <div class="container">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('frontend/images/logo.jpg') }}" alt="Kathirazhagi Boutique" class="rounded-circle shadow-sm" style="height:75px; width:75px; object-fit:cover; border: 2px solid var(--brand-secondary);">
        </a>

        {{-- MOBILE TOGGLE --}}
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#lunaNavbar" aria-controls="lunaNavbar" aria-expanded="false" aria-label="Toggle navigation">

            <i class="bi bi-list fs-2 text-white"></i>

        </button>

        <div class="collapse navbar-collapse" id="lunaNavbar">

            {{-- MENU --}}
            <ul class="navbar-nav mx-auto align-items-lg-center luna-nav-links">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop', ['sort' => 'latest']) }}">
                        New Arrivals
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        Clothing
                    </a>
                </li>

                {{-- Dynamic Categories --}}
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        Categories

                    </a>

                    <ul class="dropdown-menu border-0 shadow-sm">

                        @forelse($navCategories as $category)

                        <li>
                            <a class="dropdown-item" href="{{ route('shop', ['category' => $category->slug]) }}">

                                {{ $category->name }}

                            </a>
                        </li>

                        @empty

                        <li>
                            <span class="dropdown-item text-muted">
                                No categories available
                            </span>
                        </li>

                        @endforelse

                    </ul>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        Dresses
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        Accessories
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        Sale
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#luna-footer">
                        About
                    </a>
                </li>

            </ul>

            {{-- RIGHT ICONS --}}

            @php
            $cartCount = array_sum(session()->get('luna_cart', []));
            $wishlistCount = count(session()->get('luna_wishlist', []));
            @endphp

            <div class="luna-icons">

                {{-- Search --}}

                <a href="{{ route('shop') }}" title="Search Products">
                    <i class="bi bi-search"></i>
                </a>


                {{-- Account (Login will be added later) --}}

                <a href="{{ route('shop') }}" title="My Account">
                    <i class="bi bi-person"></i>
                </a>


                {{-- Wishlist --}}

                <a href="{{ route('wishlist.index') }}" class="nav-link position-relative text-white" style="font-size: 20px;">

                    ♡

                    <span class="badge rounded-pill" style="background: var(--brand-accent); font-size: 10px; position: absolute; top: 0; right: -5px;">

                        {{ count(session('luna_wishlist', [])) }}

                    </span>

                </a>


                {{-- Shopping Cart --}}

                <a href="{{ route('cart.index') }}" title="Shopping Bag">

                    <i class="bi bi-bag"></i>

                    @if($cartCount > 0)

                    <span class="cart-count">
                        {{ $cartCount }}
                    </span>

                    @endif

                </a>

            </div>

        </div>

    </div>

</nav>
