@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Edit Product</h3>
    <p class="text-muted">Update your boutique product details.</p>
</div>

@if($errors->any())
<div class="alert alert-danger">
    Please correct the errors below.
</div>
@endif

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('admin.products.form')

</form>

@endsection
