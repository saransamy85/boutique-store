@extends('admin.layouts.app')

@section('title', 'Orders Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Orders</h3>
        <p class="text-muted mb-0">View and manage all customer orders.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: #f0f0f0; color: #555;">
                <i class="bi bi-list-check"></i>
            </div>
            <h3>{{ number_format($totalOrders) }}</h3>
            <p>Total Orders</p>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: #fff3cd; color: #856404;">
                <i class="bi bi-envelope-paper"></i>
            </div>
            <h3>{{ number_format($pendingOrders) }}</h3>
            <p>Orders Received</p>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: #d1ecf1; color: #0c5460;">
                <i class="bi bi-truck"></i>
            </div>
            <h3>{{ number_format($dispatchedOrders) }}</h3>
            <p>Dispatched</p>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background: #d4edda; color: #155724;">
                <i class="bi bi-check-circle"></i>
            </div>
            <h3>{{ number_format($deliveredOrders) }}</h3>
            <p>Delivered</p>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th>Screenshot</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
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
                        $status = strtolower($order->order_status ?? 'pending');

                        $badgeClass = match($status) {
                        'delivered' => 'bg-success',
                        'confirmed' => 'bg-primary',
                        'pending' => 'bg-warning text-dark',
                        'cancelled' => 'bg-danger',
                        'shipped', 'dispatched' => 'bg-info text-dark',
                        default => 'bg-secondary',
                        };
                        @endphp

                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                    <td>
                        @if($order->payment_method === 'online')
                            <span class="badge bg-info text-dark">Online Payment</span>
                        @elseif($order->payment_method === 'cod')
                            <span class="badge bg-secondary">Cash on Delivery</span>
                        @else
                            <span class="badge bg-light text-dark border">{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'Unknown')) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($order->payment_method === 'online' && $order->payment_screenshot)
                        <a href="{{ asset($order->payment_screenshot) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-image"></i> View
                        </a>
                        @else
                        <span class="text-muted small">N/A</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="collapse" data-bs-target="#orderDetails{{ $order->id }}">
                            View Details
                        </button>
                    </td>
                </tr>
                
                {{-- Expandable Order Details Row --}}
                <tr id="orderDetails{{ $order->id }}" class="collapse bg-light">
                    <td colspan="8">
                        <div class="p-3 border rounded border-light">
                            <div class="row">
                                {{-- Customer Details --}}
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h6 class="fw-bold border-bottom pb-2 text-secondary">Customer Details</h6>
                                    <p class="mb-1 small"><strong>Name:</strong> {{ $order->customer_name }}</p>
                                    <p class="mb-1 small"><strong>Email:</strong> <a href="mailto:{{ $order->email }}" class="text-decoration-none">{{ $order->email }}</a></p>
                                    <p class="mb-1 small"><strong>Phone:</strong> <a href="tel:{{ $order->phone }}" class="text-decoration-none">{{ $order->phone }}</a></p>
                                    <p class="mb-1 small"><strong>Address:</strong> {{ $order->address }}</p>
                                    <p class="mb-1 small"><strong>City/State:</strong> {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</p>
                                    @if($order->notes)
                                        <p class="mb-0 small text-danger mt-2"><strong>Notes:</strong> {{ $order->notes }}</p>
                                    @endif
                                </div>

                                {{-- Order Items --}}
                                <div class="col-md-6">
                                    <h6 class="fw-bold border-bottom pb-2 text-secondary">Order Items</h6>
                                    <ul class="list-unstyled mb-3 small">
                                        @forelse($order->items as $item)
                                            <li class="mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <span class="fw-semibold">{{ $item->product_name }}</span>
                                                        <br>
                                                        <span class="text-muted">Qty: {{ $item->quantity }} x ₹{{ number_format($item->price, 2) }}</span>
                                                    </div>
                                                    <span class="fw-bold">₹{{ number_format($item->total, 2) }}</span>
                                                </div>
                                            </li>
                                        @empty
                                            <li class="text-muted">No items found for this order.</li>
                                        @endforelse
                                    </ul>
                                    
                                    <h6 class="fw-bold border-bottom pb-2 text-secondary mt-4">Update Statuses</h6>
                                    
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="mb-3 d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <label class="small fw-bold w-50">Payment Status:</label>
                                        <select name="payment_status" class="form-select form-select-sm w-100">
                                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="uploaded" {{ $order->payment_status === 'uploaded' ? 'selected' : '' }}>Uploaded</option>
                                            <option value="verified" {{ $order->payment_status === 'verified' ? 'selected' : '' }}>Verified</option>
                                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-dark">Update</button>
                                    </form>

                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <label class="small fw-bold w-50">Order Status:</label>
                                        <select name="order_status" class="form-select form-select-sm w-100">
                                            <option value="pending" {{ strtolower($order->order_status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ strtolower($order->order_status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="shipped" {{ strtolower($order->order_status) === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="dispatched" {{ strtolower($order->order_status) === 'dispatched' ? 'selected' : '' }}>Dispatched</option>
                                            <option value="delivered" {{ strtolower($order->order_status) === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled" {{ strtolower($order->order_status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-dark">Update</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5 text-muted">
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
