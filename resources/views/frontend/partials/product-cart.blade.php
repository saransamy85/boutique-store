{{-- WISHLIST BUTTON --}}

<form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="mt-2">

    @csrf

    <button type="submit" class="btn btn-sm btn-outline-secondary w-100">

        <i class="bi bi-heart me-1"></i>
        Add to Wishlist

    </button>

</form>
