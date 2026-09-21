<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class WishlistController extends Controller
{
    //
     // Display Wishlist
    public function index()
    {
        $wishlist = session()->get('luna_wishlist', []);

        $products = Product::with('category')
            ->whereIn('id', $wishlist)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->latest()
            ->get();

        return view('frontend.wishlist.index', compact('products'));
    }


    // Add Product to Wishlist
    public function add(Product $product)
    {
        $product = Product::where('id', $product->id)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->firstOrFail();

        $wishlist = session()->get('luna_wishlist', []);

        if (!in_array($product->id, $wishlist)) {
            $wishlist[] = $product->id;
        }

        session()->put('luna_wishlist', array_values($wishlist));

        return back()->with('success', 'Product added to your wishlist.');
    }


    // Remove Product from Wishlist
    public function remove(Product $product)
    {
        $wishlist = session()->get('luna_wishlist', []);

        $wishlist = array_values(
            array_diff($wishlist, [$product->id])
        );

        session()->put('luna_wishlist', $wishlist);

        return back()->with('success', 'Product removed from wishlist.');
    }


    // Move Wishlist Product to Cart
    public function moveToCart(Product $product)
    {
        $product = Product::where('id', $product->id)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->firstOrFail();

        if ($product->stock < 1) {
            return back()->with('error', 'This product is out of stock.');
        }

        $cart = session()->get('luna_cart', []);

        $currentQuantity = (int) ($cart[$product->id] ?? 0);

        if (($currentQuantity + 1) > $product->stock) {
            return back()->with(
                'error',
                'This product has reached its available stock limit.'
            );
        }

        $cart[$product->id] = $currentQuantity + 1;

        session()->put('luna_cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Wishlist product added to your cart.');
    }
}
