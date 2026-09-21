@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Add Category</h3>
    <p class="text-muted">Create a new boutique category.</p>
</div>

@if($errors->any())
<div class="alert alert-danger">
    Please correct the errors below.
</div>
@endif

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    @include('admin.categories.form')

</form>

@endsection
