@extends('frontend.layouts.app')

@php
$brand = 'Kathirazhagi Boutique';
@endphp

@section('title', 'Order Confirmed | ' . $brand)
@section('meta_description', 'Your haute couture order has been successfully placed with ' . $brand . '.')

@section('content')

{{-- ===================================================
    ORDER SUCCESS CONFIRMATION
=================================================== --}}
<section class="order-success-section py-5 position-relative overflow-hidden">
    {{-- Ambient Radiant Glow Orbs --}}
    <div class="success-ambient-glow glow-gold"></div>
    <div class="success-ambient-glow glow-berry"></div>

    <div class="container text-center py-5 position-relative z-2">

        {{-- Golden Crest Icon --}}
        <div class="success-crest-wrap mb-4" data-motion="zoom-in">
            <div class="success-crest-icon">
                <i class="bi bi-check-lg"></i>
            </div>
        </div>

        {{-- Eyebrow & Headline --}}
        <div class="success-header mb-4" data-motion="fade-up">
            <span class="success-eyebrow text-gold fw-bold letter-spacing-2 small text-uppercase">
                ✦ RESERVATION CONFIRMED ✦
            </span>
            <h1 class="success-title mt-2 mb-3">Thank You for Your Order!</h1>
            <p class="success-lead text-muted mx-auto">
                Your heirloom silhouettes have been successfully reserved. Our master atelier artisans are now preparing your pieces for express luxury dispatch.
            </p>
        </div>

        {{-- Order Receipt Details Card --}}
        <div class="card order-details-card border-0 shadow-sm mx-auto mt-4 p-4 rounded-4" style="max-width: 540px;" data-motion="fade-up" data-motion-delay="150" data-tilt="true">
            <div class="card-body p-0">
                <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom border-gold-light">
                    <h5 class="mb-0 fw-bold text-purple-deep">
                        <i class="bi bi-receipt-cutoff text-gold me-2"></i> Order Summary
                    </h5>
                    <span class="badge bg-gold-subtle text-gold-dark fw-bold px-3 py-2 rounded-pill small">
                        CONFIRMED
                    </span>
                </div>

                <div class="row g-3 text-start small">
                    <div class="col-6">
                        <span class="text-muted d-block">Order Reference:</span>
                        <strong class="text-purple-deep fs-6 font-monospace">{{ $order->order_number }}</strong>
                    </div>
                    <div class="col-6 text-end">
                        <span class="text-muted d-block">Order Total:</span>
                        <strong class="text-purple-deep fs-5">₹{{ number_format($order->total_amount, 2) }}</strong>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block">Fulfillment Status:</span>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            {{ ucfirst($order->order_status) }}
                        </span>
                    </div>
                    <div class="col-6 text-end">
                        <span class="text-muted d-block">Payment Mode:</span>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top border-gold-subtle text-center text-muted small">
                    <i class="bi bi-envelope-check text-gold me-1"></i>
                    A formal order confirmation and courier dispatch receipt have been dispatched to your email.
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-5" data-motion="fade-up" data-motion-delay="250">
            <a href="{{ route('shop') }}" class="btn-royal-gold magnetic-btn">
                <span>Continue Exploring Catalogue</span>
                <i class="bi bi-arrow-right ms-2"></i>
                <div class="btn-shimmer-sweep"></div>
            </a>
            <a href="{{ route('home') }}" class="btn-royal-glass magnetic-btn">
                <i class="bi bi-house me-2 text-gold"></i>
                <span>Return to Atelier Home</span>
            </a>
        </div>

    </div>
</section>

@endsection

@push('styles')
<style>
    :root {
        --gold-primary: #d4af37;
        --gold-light: #f3e5ab;
        --gold-dark: #b8962e;
        --purple-deep: #2e102f;
        --cream-silk: #FAF8F1;
        --ease-luxury: cubic-bezier(0.16, 1, 0.3, 1);
    }

    .order-success-section {
        background: linear-gradient(180deg, #FFFFFF 0%, #FAF8F1 60%, #FFFFFF 100%);
        min-height: 75vh;
    }

    .success-ambient-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        pointer-events: none;
        z-index: 1;
    }

    .glow-gold {
        top: 5%;
        right: 20%;
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
    }

    .glow-berry {
        bottom: 10%;
        left: 15%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(139, 75, 124, 0.18) 0%, transparent 70%);
    }

    .success-crest-icon {
        width: 84px;
        height: 84px;
        border-radius: 50%;
        background: linear-gradient(135deg, #F3E5AB 0%, #D4AF37 50%, #B8962E 100%);
        color: #2e102f;
        font-size: 2.8rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.45);
        border: 2px solid #ffffff;
    }

    .success-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 3.5vw, 2.8rem);
        font-weight: 700;
        color: var(--purple-deep);
    }

    .success-lead {
        font-size: 1rem;
        max-width: 560px;
        line-height: 1.6;
    }

    .order-details-card {
        background: #ffffff;
        border: 1.5px solid rgba(212, 175, 55, 0.35);
        box-shadow: 0 15px 40px rgba(46, 16, 47, 0.08);
    }

    .text-purple-deep {
        color: var(--purple-deep) !important;
    }

    .border-gold-light {
        border-color: rgba(212, 175, 55, 0.25) !important;
    }

    .border-gold-subtle {
        border-color: rgba(212, 175, 55, 0.15) !important;
    }

    .bg-gold-subtle {
        background: rgba(212, 175, 55, 0.15);
    }

    .text-gold-dark {
        color: var(--gold-dark) !important;
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

    .btn-royal-glass {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 13px 26px;
        border-radius: 50px;
        background: rgba(46, 16, 47, 0.05);
        color: var(--purple-deep);
        font-weight: 600;
        font-size: 0.88rem;
        letter-spacing: 0.5px;
        border: 1.5px solid rgba(212, 175, 55, 0.45);
        transition: all 0.35s var(--ease-luxury);
        text-decoration: none;
    }

    .btn-royal-glass:hover {
        background: var(--purple-deep);
        color: #ffffff;
        border-color: var(--purple-deep);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(46, 16, 47, 0.2);
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
</style>
@endpush
