<?php

namespace App\Http\Controllers;

use App\Smartphone;

class ProductController extends Controller
{
    public function show($productType, $id)
    {
        $productTypes = [
            'smartphone' => new Smartphone()
        ];

        $product = $productTypes[$productType]::find($id)->toArray();

        return view('layouts.product', [
            'product' => $product
        ]);
    }
}