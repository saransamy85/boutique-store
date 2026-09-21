@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold">Edit Category</h3>
    <p class="text-muted">Update category information.</p>
</div>

@if($errors->any())
<div class="alert alert-danger">
    Please correct the errors below.
</div>
@endif

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('admin.categories.form')

</form>

@endsection
