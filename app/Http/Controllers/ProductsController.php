<?php

namespace App\Http\Controllers;

use App\Smartphone;
use App\TV;
use Illuminate\Support\Facades\DB;
use Request;

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

    public function filter(string $productType)
    {
        $productTypes = [
            'smartphones' => new Smartphone(),
            't_v_s' => new TV()
        ];
        $sortOptionsMethods = [
            'byDefault' => "orderBy",
            'byIncreasePrise' => "orderBy",
            'byDescPrise' => "orderByDesc"
        ];
        $sortOptionsValues = [
            'byDefault' => "id",
            'byIncreasePrise' => "price",
            'byDescPrise' => "price"
        ];

        $input = Request::all();
        $arrForRequestFromDb = [];
        $optionsItems = [];
        $checkedCheckboxes = [];
        $optionsForDisplay = [];
        $sortOptionsMethod = $sortOptionsMethods[$input['sort']];
        $sortOptionsValue = $sortOptionsValues[$input['sort']];
    

        $options = DB::select(
            "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='$productType'"
        );

        foreach ($input as $key => $value) {
            if ($key !== '_token' && $key !== 'php_echo_e($productType);_?>' && $key !== 'sort') {
                if($key === 'from' || $key === 'to' || $key === 'productType') {
                    $arrForRequestFromDb[$key] = $value;
                } else {
                    $arr = explode(':', $key);
                    if (!array_key_exists($arr[0], $arrForRequestFromDb)) {
                        $arrForRequestFromDb[$arr[0]] = [];
                        array_push($arrForRequestFromDb[$arr[0]], $arr[1]);
                    } else {
                        array_push($arrForRequestFromDb[$arr[0]], $arr[1]);
                    }
                }
            }
        }

        foreach ($input as $key => $value) {
            if ($key !== '_token' && $key !== 'from' && $key !== 'to') {
                $checkedCheckboxes[] = $key;
            }
        }
        
        $products = $productTypes[$productType]::where(function ($query) use ($arrForRequestFromDb) {
            foreach ($arrForRequestFromDb as $key => $value) {
                if ($key !== 'productType') {
                    if ($key === 'from') {
                        $query->where('price', '>=', $value);
                    } else if ($key === 'to') {
                        $query->where('price', '<=', $value);
                    } else {
                        $query->whereIn($key, $value);
                    }
                }
            }
        })->$sortOptionsMethod($sortOptionsValue)->paginate(8);
        
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
        
        foreach ($optionsForDisplay as $option) {
            $optionsItems[$option] = $productTypes[$productType]::select($option)->distinct()->pluck($option)->toArray();
        }
        
        return view('layouts.products', [
            'productType' => $productType,
            'products' => $products,
            'options' => $optionsForDisplay,
            'optionsItems' => $optionsItems,
            'checkedCheckboxes' => $checkedCheckboxes,
            'inputSort' => $input["sort"]
        ]);
    }
}