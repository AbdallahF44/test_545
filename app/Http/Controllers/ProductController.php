<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Color_Product;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('status', true)->get();
        return view('products.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', true)->get();
        $colors = Color::all();
        return view('products.create', compact('categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
//        dd($request);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        $product->colors()->attach($request->input('colors'));

        toastr()->success("$request->name Product Added Successfully.");

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if (!$product->status)
            return redirect()->route('products.index');
        $categories = Category::where('status', true)->get();
        return view('products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', true)->get();
        $colors = Color::all();
        return view('products.create', compact('product', 'categories', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $prod = Product::find($product->id);
        $prod->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);
        Color_Product::where('product_id', $product->id)->delete();
//        $colors = $request->input('colors');
//        $colorToAdd = [];
//        foreach ($colors as $col) {
//            if (!in_array($col, $prod->colors->pluck('id')->all()))
//                $colorToAdd[] = $col;
//            else {
//                 Color_Product::where('product_id', $col)->delete();
//            }
//        }
        $prod->colors()->attach($request->input('colors'));
        if (!$request->status) {
            toastr()->success("$request->name Product Disabled Successfully.");

            return redirect()->route('products.index');
        } else {
            toastr()->success("$request->name Product Updated Successfully.");

            return redirect()->route('products.show', $product);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        Color_Product::where('product_id', $product->id)->delete();
        toastr()->success("$product->name Category Deleted Successfully.");

        return redirect()->route('products.index');
    }
}
