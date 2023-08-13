<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Color_Product;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $product->addMultipleMediaFromRequest(['image'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('product_images');
            });
        $product->save();


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
//        Color_Product::where('product_id', $product->id)->delete();
//        $colors = $request->input('colors');
//        $colorToAdd = [];
//        foreach ($colors as $col) {
//            if (!in_array($col, $prod->colors->pluck('id')->all()))
//                $colorToAdd[] = $col;
//            else {
//                 Color_Product::where('product_id', $col)->delete();
//            }
//        }
        // way 1
        // Color_Product::where('product_id', $product->id)->delete();
        // $prod->colors()->attach($request->input('colors'));
        // WAY 2 - NEXT LINE ONLY
        $prod->colors()->sync($request->input('colors'));

//        $existingMedia = $prod->getMedia('product_images');
//        // Delete the existing media
//        foreach ($existingMedia as $media) {
//            $media->delete();
//        }
        $prod->clearMediaCollection('product_images');
        $prod->addMultipleMediaFromRequest(['image'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('product_images');
            });
//        $prod->replaceMedia($request->file('image'))->toMediaCollection('product_images');
        $prod->save();
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

    public function editImage(Product $product, $imageId)
    {
        $image = $product->getMedia('product_images')->find($imageId);
        return view('products.edit_image', compact('product', 'image'));
    }

    public function updateImage(Request $request, Product $product, $imageId)
    {
        $image = $product->getMedia('product_images')->find($imageId);

        if (!$image) {
            toastr()->error("Image not found.");
            return redirect()->route('products.show', $product);
        }

        if ($request->hasFile('image')) {
            $image->delete(); // Delete the existing image

            $newImage = $product->addMedia($request->file('image'))->toMediaCollection('product_images');
            $newImage->save();

            toastr()->success("Image Updated Successfully.");
            return redirect()->route('products.show', $product);
        }

        toastr()->error("Image not updated. Please provide a new image.");
        return redirect()->route('products.editImage', ['product' => $product->id, 'imageId' => $imageId]);
    }

    public function deleteImage(Product $product, $imageId)
    {
        $image = $product->getMedia('product_images')->find($imageId);

//        $image->delete(); // Delete the existing image
        $product->deleteMedia($imageId);


        toastr()->success("Image Deleted Successfully.");
        return redirect()->route('products.show', $product);

    }
}
