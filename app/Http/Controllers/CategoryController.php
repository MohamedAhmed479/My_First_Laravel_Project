<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(25);

        return view('categories.view_categories', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.create_category");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validated();

        Category::create($validatedData);

        return to_route('admin.categories.index')->with('success', "Category Created Successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show_category', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit_category', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        $category->update($validatedData);

        return to_route('admin.categories.index')->with('success', "Category Updated Successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('admin.categories.index')->with('success', "Category Deleted Successfully");

    }

    public function viewCategoryProducts(Category $category) {
        $products = $category->products;

        return view('categories.view_products', get_defined_vars());

    }

    public function viewSpecificCategory(Category $category) {

        return view('categories.view_specific_category', get_defined_vars());

    }
}
