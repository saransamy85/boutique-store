@extends('admin.layouts.app')

@section('content')

<div class="container-fluid py-4">

    <h3 class="mb-1">Add Product Variant</h3>

    <p class="text-muted mb-4">
        Product: {{ $product->name }}
    </p>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('admin.products.variants.store', $product->id) }}" method="POST">

                @include('admin.products.variants._form')

            </form>

        </div>

    </div>

</div>

@endsection
