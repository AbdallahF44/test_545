<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', true)->get();
        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
        return view('categories.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'status' => true,
        ]);
        toastr()->success("$request->name Category Added Successfully.");
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if (!$category->status)
            return redirect()->route('categories.index');
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.create',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $cat = Category::find($category->id);
        $cat->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        if (!$request->status) {
            foreach ($cat->products as $product) {
                Product::find($product->id)->update([
                    'status' => false
                ]);
            }
            toastr()->success("$request->name Category Disabled Successfully.");
            return redirect()->route('categories.index');
        } else {
            toastr()->success("$request->name Category Updated Successfully.");
            return redirect()->route('categories.show', $category);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        Product::destroy($category->products);
        toastr()->success("$category->name Category Deleted Successfully.");
        return redirect()->route('categories.index');
    }
}
