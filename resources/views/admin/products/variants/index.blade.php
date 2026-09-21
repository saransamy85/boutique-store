@extends('admin.layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3>Product Variants</h3>

            <p class="text-muted mb-0">
                {{ $product->name }}
            </p>
        </div>

        <a href="{{ route('admin.products.variants.create', $product->id) }}" class="btn btn-primary">

            + Add Variant

        </a>

    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th>#</th>
                        <th>SKU</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($variants as $variant)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $variant->sku }}</td>

                        <td>{{ $variant->size ?? '-' }}</td>

                        <td>{{ $variant->color ?? '-' }}</td>

                        <td>
                            ₹{{ number_format($variant->price ?? $product->price, 2) }}
                        </td>

                        <td>
                            {{ $variant->stock }}
                        </td>

                        <td>
                            @if($variant->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>

                        <td class="d-flex gap-2">

                            <a href="{{ route('admin.products.variants.edit', [$product->id, $variant->id]) }}" class="btn btn-sm btn-outline-primary">

                                Edit

                            </a>

                            <form action="{{ route('admin.products.variants.destroy', [$product->id, $variant->id]) }}" method="POST" onsubmit="return confirm('Delete this variant?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center py-5">

                            <h5>No variants added yet</h5>

                            <p class="text-muted">
                                Add sizes and colors for this product.
                            </p>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer bg-white">
            {{ $variants->links() }}
        </div>

    </div>

</div>

@endsection
