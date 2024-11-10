<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FrontController extends Controller
{
    public function index (){
        // $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
        $categories = Category::all();
        // return view('front.index', [
        //     'products' => $products,
        //     'categories' => $categories,
        // ]);

        $offers = Product::whereHas('category', function ($query) {
            $query->where('name', 'Offer');
        })
        ->latest()
        ->take(3)
        ->get();

        $features = Product::whereHas('category', function ($query) {
            $query->where('name', 'Featured');
        })
        // ->where('is_featured', 'not_featured')
        ->latest()
        ->take(4)
        ->get();

        return view ('front.index', compact(['features', 'offers']));

    }

}
