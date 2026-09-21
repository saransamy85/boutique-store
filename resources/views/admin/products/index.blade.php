@extends('admin.layouts.app')

@section('title', 'Product Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Products</h3>
        <p class="text-muted mb-0">Manage your boutique products.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg me-2"></i> Add Product
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="content-card">

    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search product name or SKU..." value="{{ request('search') }}">
            </div>

            <div class="col-auto">
                <button class="btn btn-dark">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>

            <div class="col-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $products->firstItem() + $loop->index }}</td>

                    <td>
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" width="55" height="55" class="rounded" style="object-fit:cover">
                        @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:55px;height:55px">
                            <i class="bi bi-image fs-4 text-muted"></i>
                        </div>
                        @endif
                    </td>

                    <td>
                        <div class="fw-semibold">{{ $product->name }}</div>

                        @if($product->is_featured)
                        <span class="badge bg-warning text-dark">
                            Featured
                        </span>
                        @endif
                    </td>

                    <td>{{ $product->category->name }}</td>

                    <td>{{ $product->sku }}</td>

                    <td>
                        @if($product->sale_price !== null)
                        <span class="fw-bold">
                            ₹{{ number_format((float)$product->sale_price, 2) }}
                        </span>
                        <br>
                        <small class="text-muted text-decoration-line-through">
                            ₹{{ number_format((float)$product->price, 2) }}
                        </small>
                        @else
                        ₹{{ number_format((float)$product->price, 2) }}
                        @endif
                    </td>

                    <td>
                        @if($product->stock > 0)
                        <span class="badge bg-success">
                            {{ $product->stock }}
                        </span>
                        @else
                        <span class="badge bg-danger">Out of Stock</span>
                        @endif
                    </td>

                    <td>
                        @if($product->status)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <a href="{{ route('admin.products.variants.index', $product->id) }}" class="btn btn-sm btn-outline-success">

                            Manage Variants

                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-5 text-muted">
                        No products found.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{ $products->links() }}

</div>

@endsection
