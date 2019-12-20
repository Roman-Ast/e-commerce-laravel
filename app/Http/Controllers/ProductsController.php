<?php

namespace App\Http\Controllers;

use App\Review;
use App\Product;
use Illuminate\Support\Facades\DB;
use Request;

class ProductsController extends Controller
{
    public function show(string $productType)
    {
        $input = Request::all();
        
        $products = Product::where('category', $productType)->paginate(8);

        $options = DB::select(
            "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='products'"
        );
        $min = Product::where('category', $productType)->min('price');
        $max = Product::where('category', $productType)->max('price');
        
        $optionsForDisplay = [];

        $productsID = Review::select('product_id')->distinct()->pluck('product_id')->toArray();
        
        $reviewsCount = [];
        $averageRating = [];
        foreach ($productsID as $id) {
            $reviewsCount[$id] = Review::where('product_id', $id)->count();
            $averageRating[$id] = round(Review::where('product_id', $id)->avg('rating'), 2);
        }
        
        foreach ($options as $option) {
            foreach (get_object_vars($option) as $var) {
                if (
                    $var != 'id' && $var != 'category' && 
                    $var != 'model' && $var != 'price' &&
                    $var != 'image' && $var != 'description' &&
                    $var != 'onsale' && $var != 'created_at' &&
                    $var != 'reviews_count' && $var != 'rating' &&
                    $var != 'updated_at' && $var != 'discount_percentage'
                ) {
                    $optionsForDisplay[] = $var;
                }
            }
        }
        
        $optionsItems = [];
        foreach ($optionsForDisplay as $option) {
            $optionsItems[$option] = Product::select($option)->distinct()->pluck($option)->toArray();
            uasort($optionsItems[$option], function($a, $b) {
                return $a <=> $b;
            });
        }
        
        return view('layouts.products', [
            'reviewsCount' => $reviewsCount,
            'averageRating' => $averageRating,
            'from' => $min,
            'to' => $max,
            'productType' => $productType,
            'products' => $products,
            'options' => $optionsForDisplay,
            'optionsItems' => $optionsItems
        ]);
        
    }
    
    public function filter(string $productType)
    {
        $input = Request::all();
        
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

        $arrForRequestFromDb = [];
        $optionsItems = [];
        $checkedCheckboxes = [];
        $optionsForDisplay = [];
        $sortOptionsMethod = $sortOptionsMethods[$input['sort']];
        $sortOptionsValue = $sortOptionsValues[$input['sort']];
        $max = Product::where('category', $productType)->max('price');

        $options = DB::select(
            "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='products'"
        );

        foreach ($input as $key => $value) {
            if ($key !== '_token' && $key !== 'php_echo_e($productType);_?>' && $key !== 'sort' && $key !== 'page') {
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
        var_dump($arrForRequestFromDb);
        $products = Product::where(function ($query) use ($arrForRequestFromDb) {
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
        
        $productsID = Review::select('product_id')->distinct()->pluck('product_id')->toArray();
        
        $reviewsCount = [];
        $averageRating = [];
        foreach ($productsID as $id) {
            $reviewsCount[$id] = Review::where('product_id', $id)->count();
            $averageRating[$id] = round(Review::where('product_id', $id)->avg('rating'), 2);
        }
        
        foreach ($options as $option) {
            foreach (get_object_vars($option) as $var) {
                if (
                    $var != 'id' && $var != 'category' && 
                    $var != 'model' && $var != 'price' &&
                    $var != 'image' && $var != 'description' &&
                    $var != 'onsale' && $var != 'created_at' && 
                    $var != 'updated_at' && $var != 'reviews_count' &&
                    $var != 'rating' && $var != 'discount_percentage'
                ) {
                    $optionsForDisplay[] = $var;
                }
            }
        }
        
        foreach ($optionsForDisplay as $option) {
            $optionsItems[$option] = Product::select($option)->distinct()->pluck($option)->toArray();
        }

        $finalArr = [
            'reviewsCount' => $reviewsCount,
            'averageRating' => $averageRating,
            'from' => $input['from'],
            'to' => $max,
            'productType' => $productType,
            'products' => $products,
            'options' => $optionsForDisplay,
            'optionsItems' => $optionsItems,
            'checkedCheckboxes' => $checkedCheckboxes,
            'inputSort' => $input["sort"]
        ];

        if (!in_array('filter', explode('/', url()->current()))) {
            $products->withPath("filter/{$productType}");
        }
        $products->appends($input);

        return view('layouts.products', $finalArr);
    }
}
