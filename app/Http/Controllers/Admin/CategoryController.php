<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categories = Category::when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|boolean',
    ]);

    $validated['slug'] = Str::slug($validated['name']);

    // Upload image directly to public folder
    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/categories'), $filename);

        $validated['image'] = 'uploads/categories/' . $filename;
    }

    Category::create($validated);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
         return view('admin.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
       $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('categories', 'name')->ignore($category->id),
        ],
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status' => 'required|boolean',
    ]);

    $validated['slug'] = Str::slug($validated['name']);

    if ($request->hasFile('image')) {

        // Delete previous image
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        // Upload new image
        $image = $request->file('image');

        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/categories'), $filename);

        $validated['image'] = 'uploads/categories/' . $filename;
    }

    $category->update($validated);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        // Delete category image from public folder
    if ($category->image && file_exists(public_path($category->image))) {
        unlink(public_path($category->image));
    }

    $category->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category deleted successfully!');
    }
}
