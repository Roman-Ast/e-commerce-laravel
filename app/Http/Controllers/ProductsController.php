<?php

namespace App\Http\Controllers;

use App\Smartphone;
use App\TV;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function show(string $productType)
    {
        $productTypes = [
            'smartphones' => new Smartphone(),
            't_v_s' => new TV()
        ];

        $products = $productTypes[$productType]::paginate(8);
        $options = DB::select(
            "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='$productType'"
        );
        

        $optionsForDisplay = [];

        foreach ($options as $option) {
            foreach (get_object_vars($option) as $var) {
                if (
                    $var != 'id' && $var != 'category' && 
                    $var != 'model' && $var != 'price' &&
                    $var != 'image' && $var != 'description' &&
                    $var != 'onsale' && $var != 'created_at' && 
                    $var != 'updated_at'
                ) {
                    $optionsForDisplay[] = $var;
                }
            }
        }
        
        $optionsItems = [];
        foreach ($optionsForDisplay as $option) {
            $optionsItems[$option] = $productTypes[$productType]::select($option)->distinct()->pluck($option)->toArray();
        }

        return view('layouts.products', [
            'productType' => $productType,
            'products' => $products,
            'options' => $optionsForDisplay,
            'optionsItems' => $optionsItems
        ]);
    }

    public function filter(string $productType, Request $request)
    {
        $input = $request->all();

        return $input;  
        
    }
}