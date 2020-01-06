<?php

namespace App\Http\Controllers;

use DB;
use App\Product;
use App\Review;
use Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(8);
        
        $options = DB::select(
            "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='products'"
        );
        $min = Product::min('price');
        $max = Product::max('price');
        
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
                    $var != 'id' && $var != 'os' &&
                    $var != 'model' && $var != 'price' &&
                    $var != 'image' && $var != 'description' &&
                    $var != 'onsale' && $var != 'created_at' &&
                    $var != 'reviews_count' && $var != 'rating' &&
                    $var != 'updated_at' && $var != 'discount_percentage' &&
                    $var != 'new_price'
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
        $optionsRussian = [
            'category' => 'тип товара',
            'brand' => 'брэнд',
            'colour' => 'цвет',
            'ram' => 'оперативная память',
            'capacity' => 'встроенная память',
            'diagonal' => 'диагональ',
            'screen' => 'тип экрана',
            'resolution' => 'разрешение экрана'
        ];
        
        //return $optionsForDisplayRussian;
        return view('products.index', [
            'reviewsCount' => $reviewsCount,
            'averageRating' => $averageRating,
            'from' => $min,
            'to' => $max,
            'products' => $products,
            'options' => $optionsForDisplay,
            'optionsItems' => $optionsItems,
            'optionsRussian' => $optionsRussian
        ]);
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
                $option != 'reviews_count' && $option != 'rating' &&
                $option != 'images' && $option != 'new_price'
            ) {
               $productOptions[$option] = $value;
           }
        }
        $productsOnSale = Product::where('onsale', 'yes')
            ->where('id', '!=', $product['id'])
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $reviews = Review::where('product_id', '=', $product['id'])->latest()->get();
        $rating = Review::where('product_id', '=', $product['id'])->avg('rating');

        return view('products.show', [
            'rating' => round($rating, 1),
            'reviews' => $reviews,
            'product' => $product,
            'productOptions' => $productOptions,
            'productsOnSale' => $productsOnSale
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

    //additional methods
    public function filter()
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
        //var_dump($input);
        $arrForRequestFromDb = [];
        $optionsItems = [];
        $checkedCheckboxes = [];
        $optionsForDisplay = [];
        $sortOptionsMethod = $sortOptionsMethods[$input['sort']];
        $sortOptionsValue = $sortOptionsValues[$input['sort']];
        $max = Product::max('price');

        $options = DB::select(
            "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name='products'"
        );

        foreach ($input as $key => $value) {
            if ($key !== '_token' && $key !== 'php_echo_e($productType);_?>' && $key !== 'sort' && $key !== 'page') {
                if($key === 'from' || $key === 'to' || $key === 'productType') {
                    $arrForRequestFromDb[$key] = $value;
                } else {
                    $arr = explode(':', $key);
                    $arrExploded = explode('_', $arr[1]);
                    
                    $arr[1] = implode(' ', $arrExploded);
                    
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
            if ($key !== '_token' && $key !== 'from' && $key !== 'to' && $key != 'sort') {
                $arr = explode(':', $key);
                if (isset($arr[1])) {
                    $arrExploded = explode('_', $arr[1]);
                    $arr[1] = implode(' ', $arrExploded);
               
                    $checkedCheckboxes[] = implode(':', $arr);
                } else {
                    $checkedCheckboxes[] = $key;
                }
                
            }
        }
        
       
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
                    $var != 'id' && $var != 'os' &&
                    $var != 'model' && $var != 'price' &&
                    $var != 'image' && $var != 'description' &&
                    $var != 'onsale' && $var != 'created_at' && 
                    $var != 'updated_at' && $var != 'reviews_count' &&
                    $var != 'rating' && $var != 'discount_percentage' &&
                    $var != 'new_price'
                ) {
                    $optionsForDisplay[] = $var;
                }
            }
        }
        
        foreach ($optionsForDisplay as $option) {
            $optionsItems[$option] = Product::select($option)->distinct()->pluck($option)->toArray();
        }
        $optionsRussian = [
            'category' => 'тип товара',
            'brand' => 'брэнд',
            'colour' => 'цвет',
            'ram' => 'оперативная память',
            'capacity' => 'встроенная память',
            'diagonal' => 'диагональ',
            'screen' => 'тип экрана',
            'resolution' => 'разрешение экрана'
        ];
        $finalArr = [
            'reviewsCount' => $reviewsCount,
            'averageRating' => $averageRating,
            'from' => $input['from'],
            'to' => $max,
            'maxInSelectedCategories' => $maxInSelectedCategories ?? null,
            'products' => $products,
            'options' => $optionsForDisplay,
            'optionsItems' => $optionsItems,
            'checkedCheckboxes' => $checkedCheckboxes,
            'inputSort' => $input["sort"],
            'optionsRussian' => $optionsRussian
        ];

        if (!in_array('filter', explode('/', url()->current()))) {
            $products->withPath("filter");
        }
        $products->appends($input);

        return view('products.index', $finalArr);
    }
}
