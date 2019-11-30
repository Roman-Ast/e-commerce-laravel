<?php

namespace App\Http\Controllers;

use App\Smartphone;
use App\TV;
use App\Review;

class ProductController extends Controller
{
    public function show($productType, $id)
    {
        $productTypes = [
            'smartphone' => new Smartphone(),
            'tv' => new TV()
        ];

        $product = $productTypes[$productType]::find($id)->toArray();

        $productOptions = [];
        foreach ($product as $option => $value) {
           if (
                $option != 'model' && $option != 'price' && 
                $option != 'brand' && $option != 'category' &&
                $option != 'image' && $option != 'id' &&
                $option != 'onsale' && $option != 'category' &&
                $option != 'created_at' && $option != 'updated_at'
            ) {
               $productOptions[$option] = $value;
           }
        }

        $reviews = Review::where('product_id', '=', $id)->latest()->get()->toArray();
        
        return view('layouts.product', [
            'reviews' => $reviews,
            'product' => $product,
            'productOptions' => $productOptions
        ]);
    }
}