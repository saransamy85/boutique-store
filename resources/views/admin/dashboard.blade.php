@extends('admin.layouts.app')

@section('title', 'Boutique Dashboard')

@section('content')

{{-- Dashboard Header --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    <div>
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <p class="text-muted mb-0">
            Welcome back! Here's your store overview.
        </p>
    </div>

    <span class="badge bg-white text-dark border p-2">
        <i class="bi bi-calendar3 me-2"></i>
        {{ now()->format('d M Y') }}
    </span>

</div>


{{-- Statistics --}}
<div class="row g-4 mb-4">

    {{-- Revenue --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-currency-rupee"></i>
            </div>

            <h3>₹{{ number_format($totalRevenue, 2) }}</h3>

            <p>Total Revenue</p>

            <small class="text-muted">Confirmed & delivered orders</small>

        </div>
    </div>


    {{-- Orders --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-cart-check"></i>
            </div>

            <h3>{{ number_format($totalOrders) }}</h3>

            <p>Total Orders</p>

            <small class="text-muted">Orders received</small>

        </div>
    </div>


    {{-- Products --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-bag-heart"></i>
            </div>

            <h3>{{ number_format($totalProducts) }}</h3>

            <p>Total Products</p>

            <small class="text-muted">Products listed</small>

        </div>
    </div>


    {{-- Customers --}}
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-people"></i>
            </div>

            <h3>{{ number_format($totalCustomers) }}</h3>

            <p>Total Customers</p>

            <small class="text-muted">Registered customers</small>

        </div>
    </div>

</div>


{{-- Recent Orders --}}
<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="fw-bold mb-0">
            Recent Orders
        </h5>

        <a href="#" class="btn btn-sm btn-outline-dark">
            View All
        </a>

    </div>


    <div class="table-responsive">

        <table class="table align-middle">

            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($recentOrders as $order)

                <tr>

                    <td>
                        #{{ $order->id }}
                    </td>

                    <td>
                        {{ $order->customer_name ?? 'Guest Customer' }}
                    </td>

                    <td>
                        {{ $order->created_at?->format('d M Y') }}
                    </td>

                    <td class="fw-semibold">
                        ₹{{ number_format($order->total_amount ?? 0, 2) }}
                    </td>

                    <td>

                        @php
                        $status = strtolower($order->status ?? 'pending');

                        $badgeClass = match($status) {
                        'delivered' => 'bg-success',
                        'confirmed' => 'bg-primary',
                        'pending' => 'bg-warning text-dark',
                        'cancelled' => 'bg-danger',
                        'shipped' => 'bg-info text-dark',
                        default => 'bg-secondary',
                        };
                        @endphp

                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst($status) }}
                        </span>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">

                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                        No orders available yet.

                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
