<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    //
   public function index()
    {
         // Total Products
        $totalProducts = Product::count();

        // Total Orders
        $totalOrders = Order::count();

        // Total Customers
        $totalCustomers = User::count();

        // Total Revenue
        $totalRevenue = Order::sum('total_amount');

        // Recent Orders
        $recentOrders = Order::with('items')->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'recentOrders'
        ));
    }
    
}
