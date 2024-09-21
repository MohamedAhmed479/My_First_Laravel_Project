<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(15);

        return view('admin.products.view_products', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.products.create_product', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        // Image Uploading
        // 1- Get Image
        $image = $request->image;

        // 2- change it's current name
        $newImageName = uniqid() . '-' . $image->getClientOriginalName();

        // 3- move image to my project
        $image->storeAs('products', $newImageName, 'public');

        // 4- save new image to database record
        $validatedData['image'] = $newImageName;

        Product::create($validatedData);

        return to_route('admin.products.index')->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show_product', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.products.edit_product', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            // Delete an old image 
            Storage::delete("public/products/$product->image");

            // Image Uploading
            // 1- Get Image
            $image = $request->image;

            // 2- change it's current name
            $newImageName = uniqid() . '-' . $image->getClientOriginalName();

            // 3- move image to my project
            $image->storeAs('products', $newImageName, 'public');

            // 4- save new image to database record
            $validatedData['image'] = $newImageName;
        }

        $product->update($validatedData);

        return to_route('admin.products.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Storage::delete("public/products/$product->image");

        $product->delete();

        return to_route('admin.products.index')->with('success', 'Product Deleted Successfully');
    }


    public function searchProduct(Request $request) {
        $request->validate([
            'product_search' => 'required|numeric|exists:products,id',
        ]);

        $product_id = $request->input('product_search');
        $product = Product::where('id', $product_id)->first();

        return to_route('admin.viewSpecificProduct', ['product' => $product]);
    }

    
    public function viewSpecificProduct(Product $product) {
        return view('admin.products.view_specific_product', get_defined_vars());
        
    }
}
