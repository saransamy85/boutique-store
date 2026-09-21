<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class HomeController extends Controller
{
    //
    public function index()
{
    $categories = Category::where('status', 1)
        ->latest()
        ->get();

    $featuredProducts = Product::with('category')
        ->where('status', 1)
        ->where('is_featured', 1)
        ->whereHas('category', fn($q) => $q->where('status', 1))
        ->latest()
        ->take(8)
        ->get();

    $newArrivals = Product::with('category')
        ->where('status', 1)
        ->whereHas('category', fn($q) => $q->where('status', 1))
        ->latest()
        ->take(10)
        ->get();

    return view('frontend.home', compact(
        'categories',
        'featuredProducts',
        'newArrivals'
    ));
}
// Product Details Page
   public function productDetails($slug)
{
    // Get product with category and active variants
    $product = Product::with([
        'category',
        'variants' => function ($query) {
            $query->where('is_active', 1)
                  ->orderBy('size')
                  ->orderBy('color');
        }
    ])
    ->where('slug', $slug)
    ->where('status', 1)
    ->whereHas('category', function ($query) {
        $query->where('status', 1);
    })
    ->firstOrFail();


    // Related products
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->where('status', 1)
        ->latest()
        ->take(4)
        ->get();


    return view('frontend.product-details', compact(
        'product',
        'relatedProducts'
    ));
}
    public function shop(Request $request)
{
    $query = Product::with('category');

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    switch ($request->get('sort')) {

        case 'price_low':
            $query->orderBy('price', 'asc');
            break;

        case 'price_high':
            $query->orderBy('price', 'desc');
            break;

        case 'name':
            $query->orderBy('name', 'asc');
            break;

        default:
            $query->latest();
            break;
    }

    $products = $query->paginate(12)->withQueryString();

    $categories = Category::orderBy('name')->get();

    return view('frontend.shop', compact('products', 'categories'));
}
}
