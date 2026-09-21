@extends('frontend.layouts.app')

@section('title', 'My Wishlist | Luna Boutique')

@section('content')

<div class="container py-5">

    <h2 class="mb-2">My Wishlist</h2>

    <p class="text-muted mb-4">
        Your favourite pieces, all in one place.
    </p>


    {{-- ALERTS --}}

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif


    @if($products->count() > 0)

    <div class="row g-4">

        @foreach($products as $product)

        <div class="col-6 col-md-4 col-lg-3">

            <div class="card border-0 h-100">

                {{-- IMAGE --}}

                <a href="{{ route('product.details', $product->slug) }}">

                    <div style="background:#f4f1e9">

                        @if($product->image)

                        <img src="{{ asset($product->image) }}" class="w-100" style="height:280px;object-fit:cover" alt="{{ $product->name }}">

                        @else

                        <div class="d-flex align-items-center justify-content-center" style="height:280px">

                            <i class="bi bi-image fs-1"></i>

                        </div>

                        @endif

                    </div>

                </a>


                {{-- PRODUCT DETAILS --}}

                <div class="card-body px-0">

                    <h6>

                        <a href="{{ route('product.details', $product->slug) }}" class="text-dark">

                            {{ $product->name }}

                        </a>

                    </h6>

                    <p class="small text-muted mb-2">
                        {{ $product->category->name ?? 'Fashion' }}
                    </p>

                    <p class="fw-semibold">

                        ₹{{ number_format((float) ($product->sale_price ?? $product->price), 2) }}

                    </p>


                    {{-- MOVE TO CART --}}

                    @if($product->stock > 0)

                    <form action="{{ route('wishlist.moveToCart', $product->id) }}" method="POST">

                        @csrf

                        <button type="submit" class="btn btn-luna btn-sm w-100 mb-2">

                            <i class="bi bi-bag-plus me-1"></i>
                            Move to Bag

                        </button>

                    </form>

                    @else

                    <button class="btn btn-secondary btn-sm w-100 mb-2" disabled>

                        Out of Stock

                    </button>

                    @endif


                    {{-- REMOVE FROM WISHLIST --}}

                    <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-secondary btn-sm w-100">

                            <i class="bi bi-heartbreak me-1"></i>
                            Remove

                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    @else

    <div class="text-center py-5">

        <i class="bi bi-heart fs-1" style="color:#59633a"></i>

        <h4 class="mt-3">Your Wishlist Is Empty</h4>

        <p class="text-muted">
            Save your favourite styles here for later.
        </p>

        <a href="{{ route('shop') }}" class="btn btn-luna mt-3">
            DISCOVER PRODUCTS
        </a>

    </div>

    @endif

</div>

@endsection
