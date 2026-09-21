<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = session()->get('luna_cart', []);

        $products = Product::whereIn('id', array_keys($cart))
            ->where('status', 1)
            ->get();

        $cartItems = [];
        $subtotal = 0;

        foreach ($products as $product) {

            $quantity = (int) ($cart[$product->id] ?? 0);

            if ($quantity < 1) {
                continue;
            }

            $price = (float) (
                $product->sale_price ?? $product->price
            );

            $itemTotal = $price * $quantity;

            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $itemTotal,
            ];

            $subtotal += $itemTotal;
        }

        return view('frontend.cart.index', compact(
            'cartItems',
            'subtotal'
        ));
    }
     // Add Product to Cart
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::where('id', $product->id)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->firstOrFail();

        $quantity = (int) $request->quantity;

        if ($product->stock < 1) {
            return back()->with('error', 'This product is out of stock.');
        }

        $cart = session()->get('luna_cart', []);

        $currentQuantity = (int) ($cart[$product->id] ?? 0);

        if (($currentQuantity + $quantity) > $product->stock) {
            return back()->with(
                'error',
                'Only ' . $product->stock . ' item(s) are available in stock.'
            );
        }

        $cart[$product->id] = $currentQuantity + $quantity;

        session()->put('luna_cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to your shopping bag!');
    }
    // Update Cart Quantity
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::where('id', $product->id)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->firstOrFail();

        $quantity = (int) $request->quantity;

        if ($quantity > $product->stock) {
            return back()->with(
                'error',
                'Only ' . $product->stock . ' item(s) are available in stock.'
            );
        }

        $cart = session()->get('luna_cart', []);

        if (!array_key_exists($product->id, $cart)) {
            return redirect()->route('cart.index');
        }

        $cart[$product->id] = $quantity;

        session()->put('luna_cart', $cart);

        return back()->with('success', 'Cart quantity updated.');
    }


    // Remove Product from Cart
    public function remove(Product $product)
    {
        $cart = session()->get('luna_cart', []);

        unset($cart[$product->id]);

        session()->put('luna_cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }

}
