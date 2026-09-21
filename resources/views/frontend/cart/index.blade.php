@extends('frontend.layouts.app')

@section('title', 'Shopping Bag | Luna Boutique')

@section('content')

<div class="container py-5">

    <h2 class="mb-2">Your Shopping Bag</h2>

    <p class="text-muted mb-4">
        Review your selected pieces before checkout.
    </p>

    {{-- ALERT MESSAGES --}}

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

    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif


    @if(count($cartItems) > 0)

    <div class="row g-4">

        {{-- CART PRODUCTS --}}

        <div class="col-lg-8">

            @foreach($cartItems as $item)

            <div class="card border-0 border-bottom rounded-0 mb-3">

                <div class="card-body px-0">

                    <div class="row align-items-center g-3">

                        {{-- IMAGE --}}

                        <div class="col-4 col-md-3">

                            <a href="{{ route('product.details', $item['product']->slug) }}">

                                @if($item['product']->image)

                                <img src="{{ asset($item['product']->image) }}" class="img-fluid" style="width:100%;height:150px;object-fit:cover" alt="{{ $item['product']->name }}">

                                @else

                                <div class="d-flex align-items-center justify-content-center" style="height:150px;background:#f4f1e9">

                                    <i class="bi bi-image fs-2"></i>

                                </div>

                                @endif

                            </a>

                        </div>


                        {{-- PRODUCT DETAILS --}}

                        <div class="col-8 col-md-9">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <h6 class="mb-2">

                                        <a href="{{ route('product.details', $item['product']->slug) }}" class="text-dark">

                                            {{ $item['product']->name }}

                                        </a>

                                    </h6>

                                    <p class="small text-muted mb-2">
                                        SKU: {{ $item['product']->sku }}
                                    </p>

                                    <p class="fw-semibold mb-3">
                                        ₹{{ number_format($item['price'], 2) }}
                                    </p>

                                </div>

                                {{-- REMOVE --}}

                                <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm text-danger" title="Remove Product">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </div>


                            {{-- QUANTITY UPDATE --}}

                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="d-flex align-items-center gap-2">

                                @csrf
                                @method('PATCH')

                                <label class="small text-muted">
                                    Qty:
                                </label>

                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}" class="form-control form-control-sm" style="width:75px" required>

                                <button type="submit" class="btn btn-sm btn-outline-dark">

                                    Update

                                </button>

                            </form>


                            <div class="mt-3 small">

                                <span class="text-muted">Item Total:</span>

                                <strong>
                                    ₹{{ number_format($item['total'], 2) }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>


        {{-- ORDER SUMMARY --}}

        <div class="col-lg-4">

            <div class="card border-0 p-4" style="background:#f6f5f0">

                <h5 class="mb-4">Order Summary</h5>

                <div class="d-flex justify-content-between mb-3">

                    <span>Subtotal</span>

                    <strong>
                        ₹{{ number_format($subtotal, 2) }}
                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-3">

                    <span>Shipping</span>

                    <span class="text-muted small">
                        Calculated at checkout
                    </span>

                </div>

                <hr>

                <div class="d-flex justify-content-between mb-4">

                    <strong>Estimated Total</strong>

                    <strong style="color:#59633a">
                        ₹{{ number_format($subtotal, 2) }}
                    </strong>

                </div>

                <a href="{{ route('shop') }}" class="btn btn-luna w-100 mb-3">

                    CONTINUE SHOPPING

                </a>

                <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100">

                    PROCEED TO CHECKOUT

                </a>

                <p class="small text-muted text-center mt-3 mb-0">
                    Checkout will be enabled in the next phase.
                </p>

            </div>

        </div>

    </div>

    @else

    {{-- EMPTY CART --}}

    <div class="text-center py-5">

        <i class="bi bi-bag fs-1" style="color:#59633a"></i>

        <h4 class="mt-3">Your Bag Is Empty</h4>

        <p class="text-muted">
            Looks like you haven't added anything to your bag yet.
        </p>

        <a href="{{ route('shop') }}" class="btn btn-luna mt-3">
            EXPLORE COLLECTION
        </a>

    </div>

    @endif

</div>

@endsection
