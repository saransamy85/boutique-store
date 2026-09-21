@extends('frontend.layouts.app')

@section('title', 'Checkout | Luna Boutique')

@section('content')

<style>
    .checkout-section {
        padding: 55px 0 80px;
        background: #fff;
    }

    .checkout-title {
        font-family: 'Playfair Display', serif;
        font-size: 38px;
    }

    .checkout-card {
        background: #fff;
        border: 1px solid #eee;
        padding: 30px;
        border-radius: 6px;
    }

    .checkout-card h4 {
        font-family: 'Playfair Display', serif;
        margin-bottom: 25px;
    }

    .checkout-card .form-control {
        border-radius: 0;
        padding: 12px;
        border-color: #ddd;
    }

    .checkout-card .form-control:focus {
        border-color: #59663c;
        box-shadow: none;
    }

    .checkout-label {
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .checkout-summary {
        background: #f7f6f2;
        padding: 25px;
    }

    .checkout-summary h4 {
        font-family: 'Playfair Display', serif;
    }

    .checkout-btn {
        background: #59663c;
        color: #fff;
        border: 0;
        padding: 15px;
        width: 100%;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .checkout-btn:hover {
        background: #414c2b;
        color: #fff;
    }

    @media(max-width: 576px) {
        .checkout-title {
            font-size: 30px;
        }

        .checkout-card {
            padding: 20px;
        }
    }

</style>

<section class="checkout-section">

    <div class="container">

        <div class="text-center mb-5">

            <h1 class="checkout-title">Checkout</h1>

            <p class="text-muted">
                Complete your details to place your order.
            </p>

        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            Please check the information you entered.
        </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">

            @csrf

            <div class="row g-4">

                {{-- Customer Details --}}
                <div class="col-lg-7">

                    <div class="checkout-card">

                        <h4>Shipping Information</h4>

                        <div class="mb-3">
                            <label class="checkout-label">Full Name *</label>

                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>

                            @error('customer_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="checkout-label">Email *</label>

                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="checkout-label">Mobile Number *</label>

                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label class="checkout-label">Address *</label>

                            <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="checkout-label">City *</label>

                                <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="checkout-label">State *</label>

                                <input type="text" name="state" class="form-control" value="{{ old('state') }}" required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label class="checkout-label">Pincode *</label>

                            <input type="text" name="pincode" class="form-control" value="{{ old('pincode') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="checkout-label">
                                Order Notes (Optional)
                            </label>

                            <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                        </div>

                    </div>

                </div>

                {{-- Order Summary --}}
                <div class="col-lg-5">

                    <div class="checkout-summary">

                        <h4 class="mb-4">Your Order</h4>

                        @foreach($cartItems as $item)

                        <div class="d-flex justify-content-between mb-3">

                            <div class="pe-3">

                                <div class="fw-semibold">
                                    {{ $item['product']->name }}
                                </div>

                                <small class="text-muted">
                                    Qty: {{ $item['quantity'] }}
                                </small>

                            </div>

                            <div class="text-nowrap">
                                ₹{{ number_format($item['item_total'], 2) }}
                            </div>

                        </div>

                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>

                            <strong>
                                ₹{{ number_format($subtotal, 2) }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>

                            <strong>
                                {{ $shipping == 0 ? 'Free' : '₹'.number_format($shipping, 2) }}
                            </strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">

                            <strong>Order Total</strong>

                            <strong style="color:#59663c;font-size:20px;">
                                ₹{{ number_format($total, 2) }}
                            </strong>

                        </div>

                        <div class="alert alert-light small">
                            Payment options will be available in the next phase.
                        </div>

                        <button type="submit" class="checkout-btn">
                            PLACE ORDER
                        </button>

                        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark w-100 mt-3">

                            RETURN TO CART

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</section>

@endsection
