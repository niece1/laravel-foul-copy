<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
 {
     $products = Product::inRandomOrder()->get();
   //  $categories = Category::all();
   //  $tags = Tag::all();

     return view('shop.index', compact('products'));
 }

 public function show($slug)
 {
 	$product = Product::where('slug', $slug)->firstOrFail();
 	$mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();
   // $one->viewedCounter();

     return view('shop.show', compact('product', 'mightAlsoLike'));
 }
}
