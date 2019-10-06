<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);
        
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product(); // this query need only to avoid mistake in articles/create because of old values from edit

        return view('products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
         'name' => 'required|min:2',
         'slug' => 'required|min:2|unique:products,slug',
         'details' => '',
         'image' => 'sometimes|file|image|max:5000',
         'price' => 'required',
         'description' => 'required',
     ]);
        $product = Product::create($data);
        $this->storeImage($product);

     // $this->getUser($product);

        
        return redirect('products'); //return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->input('slug') == $product->slug) {

            $data = request()->validate([
              'name' => 'required|min:2',
              'details' => '',
              'image' => 'sometimes|file|image|max:5000',
              'price' => 'required',
              'description' => 'required',
          ]);
        }
        
        else{
            $data = request()->validate([
                'name' => 'required|min:2',
                'slug' => 'required|min:2|unique:products,slug',   
                'details' => '',
                'image' => 'sometimes|file|image|max:5000',
                'price' => 'required',
                'description' => 'required',
            ]);
        }
        $product->update($data);

        $this->storeImage($product);

 //    $this->getUser($product);
        return redirect('products/' . $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products');
    }

    public function validateUpdateRequest()
    {
        if ($request->input('name') == $product->name)  {

            return request()->validate([

              'details' => '',
              'image' => 'sometimes|file|image|max:5000',
              'price' => 'required',
              'description' => 'required',
          ]); 
        }else{
            return request()->validate([
                'name' => 'required|min:2|unique:products,name',
                'slug' => 'required|min:2|unique:products,slug',
                'details' => '',
                'image' => 'sometimes|file|image|max:5000',
                'price' => 'required',
                'description' => 'required',
            ]);
        }
    }

    private function storeImage($product)
    {
        if(request()->has('image')) {
            $product->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
            $image = Image::make(public_path('storage/' . $product->image))->fit(300, 300);
            $image->save();
        }
    } 
}
