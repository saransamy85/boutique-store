@extends('frontend.layouts.app')

@section('title', 'Order Confirmed | Luna Boutique')

@section('content')

<section class="py-5">

    <div class="container text-center py-5">

        <div style="font-size:60px;color:#59663c;">
            ✓
        </div>

        <h1 style="font-family:'Playfair Display',serif;">
            Thank You for Your Order!
        </h1>

        <p class="text-muted mt-3">
            Your order has been placed successfully.
        </p>

        <div class="card border-0 shadow-sm mx-auto mt-4" style="max-width:500px;">

            <div class="card-body p-4">

                <h5>Order Details</h5>

                <hr>

                <p>
                    <strong>Order Number:</strong><br>
                    {{ $order->order_number }}
                </p>

                <p>
                    <strong>Order Total:</strong><br>
                    ₹{{ number_format($order->total_amount, 2) }}
                </p>

                <p>
                    <strong>Order Status:</strong><br>
                    {{ ucfirst($order->order_status) }}
                </p>

                <p>
                    <strong>Payment Status:</strong><br>
                    {{ ucfirst($order->payment_status) }}
                </p>

            </div>

        </div>

        <a href="{{ route('shop') }}" class="btn btn-dark mt-4 px-4 py-3">

            CONTINUE SHOPPING

        </a>

    </div>

</section>

@endsection
