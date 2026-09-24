<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class InventoryController extends Controller
{
    public function index()
    {
        // Load products with their variants
        $products = Product::with('variants', 'category')->latest()->get();

        return view('admin.inventory.index', compact('products'));
    }
}
