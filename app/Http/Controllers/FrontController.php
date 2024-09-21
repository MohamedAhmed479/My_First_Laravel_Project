<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $firstProducts = Product::take(8)->skip(0)->get();
        $secondeProducts = Product::take(8)->skip(8)->get();

        return view('front.index', get_defined_vars());
    }

    public function shop() {
        $products = Product::paginate(8);

        return view('front.shop', get_defined_vars());
    }



}
