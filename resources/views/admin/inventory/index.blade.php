@extends('admin.layouts.app')

@section('title', 'Inventory Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Inventory Management</h3>
        <p class="text-muted mb-0">Manage your product stock levels across all variants.</p>
    </div>
</div>

<div class="content-card">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Variants (Size/Color)</th>
                    <th>Current Stock</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    @if($product->variants->count() > 0)
                        @foreach($product->variants as $variant)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $product->name }}</h6>
                                        <small class="text-muted">{{ $product->category->name ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $variant->sku ?? $product->sku ?? 'N/A' }}</td>
                            <td>
                                @if($variant->size) <span class="badge bg-secondary me-1">{{ $variant->size }}</span> @endif
                                @if($variant->color) <span class="badge bg-secondary">{{ $variant->color }}</span> @endif
                            </td>
                            <td>
                                <span class="fw-bold {{ $variant->stock > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $variant->stock }}
                                </span>
                            </td>
                            <td>
                                @if($variant->stock > 0)
                                    <span class="badge bg-success">In Stock</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $product->name }}</h6>
                                        <small class="text-muted">{{ $product->category->name ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->sku ?? 'N/A' }}</td>
                            <td><span class="text-muted small">Standard (No variants)</span></td>
                            <td>
                                <span class="fw-bold {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-success">In Stock</span>
                                @else
                                    <span class="badge bg-danger">Out of Stock</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                            No products found in inventory.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
