<div class="content-card">

    <div class="mb-3">
        <label class="form-label fw-semibold">Category Name *</label>

        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name ?? '') }}" placeholder="Enter category name">

        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Description</label>

        <textarea name="description" rows="4" class="form-control" placeholder="Enter category description">{{ old('description', $category->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Category Image</label>

        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">

        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if(isset($category) && $category->image)
        <div class="mt-3">
            <img src="{{ asset('storage/'.$category->image) }}" width="100" height="100" class="rounded" style="object-fit:cover">

            <p class="text-muted small mt-1">Current category image</p>
        </div>
        @endif
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Status *</label>

        <select name="status" class="form-select">
            <option value="1" {{ (string) old('status', $category->status ?? 1) === '1' ? 'selected' : '' }}>
                Active
            </option>

            <option value="0" {{ (string) old('status', $category->status ?? 1) === '0' ? 'selected' : '' }}>
                Inactive
            </option>
        </select>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-dark">
            <i class="bi bi-check-circle me-1"></i>
            {{ isset($category) ? 'Update Category' : 'Save Category' }}
        </button>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            Cancel
        </a>
    </div>

</div>
