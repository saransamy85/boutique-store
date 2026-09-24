<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch registered users (if any)
        $users = User::latest()->get();
        
        // Fetch guest customers from orders (unique by email)
        $guestCustomers = Order::select('customer_name', 'email', 'phone', 'address', 'city', 'state', 'pincode')
            ->whereNotIn('email', $users->pluck('email'))
            ->groupBy('email', 'customer_name', 'phone', 'address', 'city', 'state', 'pincode')
            ->get();

        return view('admin.customers.index', compact('users', 'guestCustomers'));
    }
}
