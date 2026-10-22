<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    // Display Checkout Page
    public function index()
    {
        $cart = session()->get('luna_cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your shopping cart is empty.');
        }

        // Collect product IDs
        $productIds = [];
        foreach ($cart as $key => $item) {
            $productIds[] = is_array($item) ? ($item['product_id'] ?? $key) : $key;
        }
        $productIds = array_unique(array_filter($productIds));

        $products = Product::with(['category', 'variants.images'])
            ->whereIn('id', $productIds)
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

            $variant = null;
            if ($variantId && $product->variants) {
                $variant = $product->variants->firstWhere('id', $variantId);
            }

            $price = (float) (
                $variant?->price ?? $product->sale_price ?? $product->price
            );

            $itemTotal = $price * $quantity;
            $subtotal += $itemTotal;

            $displayImage = $selectedImage ?: ($variant?->images?->first()?->image_path ?: $product->image);

            $cartItems[] = [
                'cart_key' => $cartKey,
                'product' => $product,
                'variant' => $variant,
                'quantity' => $quantity,
                'price' => $price,
                'item_total' => $itemTotal,
                'selected_image' => $displayImage,
            ];
        }

        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart has no valid products.');
        }

        // Complimentary shipping
        $shipping = 0;
        $total = $subtotal + $shipping;

        return view('frontend.checkout.index', compact(
            'cartItems',
            'subtotal',
            'shipping',
            'total'
        ));
    }

    // Place Order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',

            'address' => 'required|string|max:1000',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',

            'notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:cod,online',
            'payment_screenshot' => 'required_if:payment_method,online|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cart = session()->get('luna_cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your shopping cart is empty.');
        }

        $screenshotPath = null;
        if ($validated['payment_method'] === 'online' && $request->hasFile('payment_screenshot')) {
            $file = $request->file('payment_screenshot');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/payments'), $filename);
            $screenshotPath = 'uploads/payments/' . $filename;
        }

        $order = DB::transaction(function () use ($cart, $validated, $screenshotPath) {
            $productIds = [];
            foreach ($cart as $key => $item) {
                $productIds[] = is_array($item) ? ($item['product_id'] ?? $key) : $key;
            }
            $productIds = array_unique(array_filter($productIds));

            $products = Product::with(['category', 'variants.images'])
                ->whereIn('id', $productIds)
                ->get()
                ->keyBy('id');

            $subtotal = 0;
            $items = [];

            foreach ($cart as $cartKey => $item) {
                $productId = is_array($item) ? ($item['product_id'] ?? $cartKey) : $cartKey;
                $quantity = is_array($item) ? (int)($item['quantity'] ?? 0) : (int)$item;
                $selectedImage = is_array($item) ? ($item['selected_image'] ?? null) : null;
                $variantId = is_array($item) ? ($item['variant_id'] ?? null) : null;

                if ($quantity < 1) {
                    continue;
                }

                if (!isset($products[$productId])) {
                    throw ValidationException::withMessages([
                        'cart' => 'A product in your cart is no longer available.',
                    ]);
                }

                $product = $products[$productId];

                $variant = null;
                if ($variantId && $product->variants) {
                    $variant = $product->variants->firstWhere('id', $variantId);
                }

                $price = (float) (
                    $variant?->price ?? $product->sale_price ?? $product->price
                );

                $itemTotal = $price * $quantity;
                $subtotal += $itemTotal;

                $displayImage = $selectedImage ?: ($variant?->images?->first()?->image_path ?: $product->image);

                $productDisplayName = $product->name;
                if ($variant) {
                    $variantDetails = array_filter([$variant->color, $variant->size]);
                    if (!empty($variantDetails)) {
                        $productDisplayName .= ' (' . implode(' / ', $variantDetails) . ')';
                    }
                }

                $items[] = [
                    'product_id' => $product->id,
                    'product_name' => $productDisplayName,
                    'sku' => $variant?->sku ?? $product->sku ?? null,
                    'image' => $displayImage,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];

                // Decrement stock accurately
                if ($variant) {
                    $variant->decrement('stock', min((int)$variant->stock, $quantity));
                } elseif ($product->variants()->count() > 0) {
                    $remaining = $quantity;
                    foreach ($product->variants as $v) {
                        if ($remaining <= 0) break;
                        if ($v->stock > 0) {
                            $take = min($v->stock, $remaining);
                            $v->stock -= $take;
                            $v->save();
                            $remaining -= $take;
                        }
                    }
                } else {
                    $product->decrement('stock', min((int)$product->stock, $quantity));
                }
            }

            // Complimentary shipping
            $shipping = 0;

            $order = Order::create([
                'order_number' => 'KATHIRAZHAGI-' . strtoupper(Str::random(10)),
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'subtotal' => $subtotal,
                'shipping_charge' => $shipping,
                'total_amount' => $subtotal + $shipping,
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'online' ? 'uploaded' : 'pending',
                'payment_screenshot' => $screenshotPath,
                'order_status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            $order->items()->createMany($items);

            return $order;
        });

        try {
            // Admin notification
            Mail::to('cloudinfo2020@gmail.com')->send(new OrderPlaced($order));

            // Customer notification
            Mail::to($order->email)->send(new \App\Mail\CustomerThankYou($order));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send order email: ' . $e->getMessage());
        }

        // Clear cart only after successful order creation
        session()->forget('luna_cart');

        return redirect()->route('checkout.success', $order->id);
    }

    // Order Confirmation
    public function success(Order $order)
    {
        return view('frontend.checkout.success', compact('order'));
    }
}
