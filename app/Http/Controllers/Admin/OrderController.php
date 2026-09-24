<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('items')->latest()->get();

        $totalOrders = Order::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $dispatchedOrders = Order::where('order_status', 'dispatched')->count();
        $deliveredOrders = Order::where('order_status', 'delivered')->count();

        return view('admin.orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'dispatchedOrders',
            'deliveredOrders'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = \App\Models\Order::findOrFail($id);

        $request->validate([
            'payment_status' => 'nullable|string',
            'order_status' => 'nullable|string',
        ]);

        if ($request->has('payment_status')) {
            $order->payment_status = $request->payment_status;
        }

        if ($request->has('order_status')) {
            $order->order_status = $request->order_status;
        }

        $order->save();

        return back()->with('success', 'Order status updated successfully!');
    }
}
