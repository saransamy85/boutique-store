@extends('admin.layouts.app')

@section('title', 'Category Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h3 class="fw-bold mb-1">Categories</h3>
        <p class="text-muted mb-0">Manage your boutique product categories.</p>
    </div>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-dark">
        <i class="bi bi-plus-lg me-2"></i> Add Category
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="content-card">

    <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search category..." value="{{ request('search') }}">
            </div>

            <div class="col-auto">
                <button class="btn btn-dark">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>

            <div class="col-auto">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
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
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $categories->firstItem() + $loop->index }}</td>

                    <td>
                        @if($category->image)
                        <img src="{{ asset($category->image) }}" width="55" height="55" class="rounded" style="object-fit:cover">
                        @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:55px;height:55px">
                            <i class="bi bi-image text-muted fs-4"></i>
                        </div>
                        @endif
                    </td>

                    <td class="fw-semibold">{{ $category->name }}</td>

                    <td>{{ $category->slug }}</td>

                    <td>
                        @if($category->status)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        No categories found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>

</div>

@endsection
