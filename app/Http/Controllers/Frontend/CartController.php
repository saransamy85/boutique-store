<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Display Shopping Cart
    public function index()
    {
        $cart = session()->get('luna_cart', []);

        // Collect all unique product IDs
        $productIds = [];
        foreach ($cart as $key => $item) {
            $productIds[] = is_array($item) ? ($item['product_id'] ?? $key) : $key;
        }
        $productIds = array_unique(array_filter($productIds));

        $products = Product::with(['category', 'variants.images'])
            ->whereIn('id', $productIds)
            ->where('status', 1)
            ->get()
            ->keyBy('id');

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $cartKey => $item) {
            $productId = is_array($item) ? ($item['product_id'] ?? $cartKey) : $cartKey;
            $quantity = is_array($item) ? (int)($item['quantity'] ?? 0) : (int)$item;
            $selectedImage = is_array($item) ? ($item['selected_image'] ?? null) : null;
            $variantId = is_array($item) ? ($item['variant_id'] ?? null) : null;

            if ($quantity < 1 || !isset($products[$productId])) {
                continue;
            }

            $product = $products[$productId];

            // Resolve variant if specified
            $variant = null;
            if ($variantId && $product->variants) {
                $variant = $product->variants->firstWhere('id', $variantId);
            }

            $price = (float) (
                $variant?->price ?? $product->sale_price ?? $product->price
            );

            $itemTotal = $price * $quantity;

            // Determine image to display: user-selected thumbnail > variant image > product main image
            $displayImage = $selectedImage ?: ($variant?->images?->first()?->image_path ?: $product->image);

            $cartItems[] = [
                'cart_key' => $cartKey,
                'product' => $product,
                'variant' => $variant,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $itemTotal,
                'selected_image' => $displayImage,
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
            'variant_id' => ['nullable', 'integer'],
            'selected_image' => ['nullable', 'string'],
        ]);

        $product = Product::with(['category', 'variants.images'])
            ->where('id', $product->id)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->firstOrFail();

        $quantity = (int) $request->quantity;
        $variantId = $request->input('variant_id');
        $variant = null;
        $maxStock = (int) $product->stock;

        if ($variantId) {
            $variant = $product->variants->firstWhere('id', $variantId);
            if ($variant) {
                $maxStock = (int) $variant->stock;
            }
        }

        if ($maxStock < 1) {
            return back()->with('error', 'This product or selected shade is out of stock.');
        }

        // Clean & normalize selected_image
        $selectedImage = $request->input('selected_image');
        if ($selectedImage) {
            $baseUrl = url('/');
            if (str_starts_with($selectedImage, $baseUrl)) {
                $selectedImage = ltrim(substr($selectedImage, strlen($baseUrl)), '/');
            }
        }
        if (empty($selectedImage)) {
            if ($variant && $variant->images->isNotEmpty()) {
                $selectedImage = $variant->images->first()->image_path;
            } else {
                $selectedImage = $product->image;
            }
        }

        $cart = session()->get('luna_cart', []);

        // Composite key ensures each selected thumbnail/variant is maintained independently
        $imageHash = substr(md5($selectedImage ?? 'default'), 0, 8);
        $cartKey = $product->id . ($variantId ? '_v' . $variantId : '') . '_' . $imageHash;

        // Current quantity for this item
        $currentQuantity = 0;
        if (isset($cart[$cartKey])) {
            $currentQuantity = is_array($cart[$cartKey]) ? (int)($cart[$cartKey]['quantity'] ?? 0) : (int)$cart[$cartKey];
        } elseif (isset($cart[$product->id]) && !$variantId) {
            // Migrate legacy entry
            $currentQuantity = is_array($cart[$product->id]) ? (int)($cart[$product->id]['quantity'] ?? 0) : (int)$cart[$product->id];
            unset($cart[$product->id]);
        }

        if (($currentQuantity + $quantity) > $maxStock) {
            return back()->with(
                'error',
                'Only ' . $maxStock . ' item(s) are available in stock.'
            );
        }

        $cart[$cartKey] = [
            'product_id' => $product->id,
            'variant_id' => $variantId ?: null,
            'quantity' => $currentQuantity + $quantity,
            'selected_image' => $selectedImage,
        ];

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
            'cart_key' => ['nullable', 'string'],
        ]);

        $product = Product::where('id', $product->id)
            ->where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 1);
            })
            ->firstOrFail();

        $quantity = (int) $request->quantity;
        $cart = session()->get('luna_cart', []);
        $cartKey = $request->input('cart_key');

        $targetKey = null;
        if ($cartKey && isset($cart[$cartKey])) {
            $targetKey = $cartKey;
        } elseif (isset($cart[$product->id])) {
            $targetKey = $product->id;
        } else {
            foreach ($cart as $k => $item) {
                $pId = is_array($item) ? ($item['product_id'] ?? null) : $k;
                if ($pId == $product->id) {
                    $targetKey = $k;
                    break;
                }
            }
        }

        if (!$targetKey || !isset($cart[$targetKey])) {
            return redirect()->route('cart.index');
        }

        $itemData = $cart[$targetKey];
        $maxStock = (int) $product->stock;
        if (is_array($itemData) && !empty($itemData['variant_id'])) {
            $variant = $product->variants()->where('id', $itemData['variant_id'])->first();
            if ($variant) {
                $maxStock = (int) $variant->stock;
            }
        }

        if ($quantity > $maxStock) {
            return back()->with(
                'error',
                'Only ' . $maxStock . ' item(s) are available in stock.'
            );
        }

        if (is_array($cart[$targetKey])) {
            $cart[$targetKey]['quantity'] = $quantity;
        } else {
            $cart[$targetKey] = $quantity;
        }

        session()->put('luna_cart', $cart);

        return back()->with('success', 'Cart quantity updated.');
    }

    // Remove Product from Cart
    public function remove(Request $request, Product $product)
    {
        $cart = session()->get('luna_cart', []);
        $cartKey = $request->input('cart_key');

        if ($cartKey && isset($cart[$cartKey])) {
            unset($cart[$cartKey]);
        } elseif (isset($cart[$product->id])) {
            unset($cart[$product->id]);
        } else {
            foreach ($cart as $k => $item) {
                $pId = is_array($item) ? ($item['product_id'] ?? null) : $k;
                if ($pId == $product->id) {
                    unset($cart[$k]);
                }
            }
        }

        session()->put('luna_cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }
}
