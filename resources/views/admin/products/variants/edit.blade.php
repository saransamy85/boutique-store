@extends('admin.layouts.app')

@section('content')

<div class="container-fluid py-4">

    <h3 class="mb-1">Edit Product Variant</h3>

    <p class="text-muted mb-4">
        Product: {{ $product->name }}
    </p>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('admin.products.variants.update', [$product->id, $variant->id]) }}" method="POST">

                @method('PUT')

                @include('admin.products.variants._form')

            </form>

        </div>

    </div>

</div>

@endsection
