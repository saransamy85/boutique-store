<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    //
    // Display Checkout Page
    public function index()
    {
        $cart = session()->get('luna_cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your shopping cart is empty.');
        }

        $products = Product::whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $productId => $quantity) {

            if (!isset($products[$productId])) {
                continue;
            }

            $product = $products[$productId];

            $price = $product->sale_price ?? $product->price;

            $itemTotal = $price * $quantity;

            $subtotal += $itemTotal;

            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'price' => $price,
                'item_total' => $itemTotal,
            ];
        }

        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart has no valid products.');
        }

        // Keep shipping free for now
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

            $products = Product::whereIn('id', array_keys($cart))
                ->get()
                ->keyBy('id');

            $subtotal = 0;
            $items = [];

            foreach ($cart as $productId => $quantity) {

                if (!isset($products[$productId])) {
                    throw ValidationException::withMessages([
                        'cart' => 'A product in your cart is no longer available.',
                    ]);
                }

                $product = $products[$productId];

                $price = $product->sale_price ?? $product->price;

                $itemTotal = $price * $quantity;

                $subtotal += $itemTotal;

                $items[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'sku' => $product->sku ?? null,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];

                // Decrement stock
                if ($product->variants()->count() > 0) {
                    $remaining = $quantity;
                    foreach ($product->variants as $variant) {
                        if ($remaining <= 0) break;
                        if ($variant->stock > 0) {
                            $take = min($variant->stock, $remaining);
                            $variant->stock -= $take;
                            $variant->save();
                            $remaining -= $take;
                        }
                    }
                } else {
                    $product->stock -= $quantity;
                    $product->save();
                }
            }

            // Free shipping for now
            $shipping = 0;

            $order = Order::create([

                'order_number' => 'LUNA-' . strtoupper(Str::random(10)),

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

        // Clear cart only after successful order creation
        session()->forget('luna_cart');

        return redirect()
            ->route('checkout.success', $order->id);
    }

    // Order Confirmation
    public function success(Order $order)
    {
        return view('frontend.checkout.success', compact('order'));
    }
}
