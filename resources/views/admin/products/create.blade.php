@extends('admin.layouts.app')

@section('title', 'Add Product')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Add Product</h3>
    <p class="text-muted">Add a new product to your boutique store.</p>
</div>

@if($errors->any())
<div class="alert alert-danger">
    Please correct the errors below.
</div>
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    @include('admin.products.form')

</form>

@endsection
