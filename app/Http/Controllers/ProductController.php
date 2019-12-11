<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::findOrFail($product['id'])->toArray();

        $productOptions = [];
        foreach ($product as $option => $value) {
           if (
                $option != 'model' && $option != 'price' && 
                $option != 'brand' && $option != 'category' &&
                $option != 'image' && $option != 'id' &&
                $option != 'onsale' && $option != 'created_at' && 
                $option != 'updated_at' && $option != 'discount_persentage' &&
                $option != 'reviews_count' && $option != 'rating'
            ) {
               $productOptions[$option] = $value;
           }
        }
        
        $reviews = Review::where('product_id', '=', $product['id'])->latest()->get();
        $rating = Review::where('product_id', '=', $product['id'])->avg('rating');
        
        return view('layouts.product', [
            'rating' => round($rating, 1),
            'reviews' => $reviews,
            'product' => $product,
            'productOptions' => $productOptions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
