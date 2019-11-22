<?php

namespace App\Http\Controllers;

use App\Smartphone;

class ProductTypeController extends Controller
{
    public function show($productType)
    {
        $productTypes = [
            'smartphone' => new Smartphone()
        ];

        $products = $productTypes[$productType]::where('category', '=', 'smartphone')->paginate(6);
        return view('layouts.products', [
            'productType' => $productType,
            'products' => $products
        ]);
    }
}