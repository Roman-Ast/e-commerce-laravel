<?php

namespace App\Http\Controllers;

use App\Review;
use Request;
use App\Smartphone;
use App\TV;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'her';
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
        $input = Request::all();

        $productTypes = [
            'smartphone' => Smartphone::findOrFail($input['product_id']),
            'tv' => Tv::findOrFail($input['product_id'])
        ];

        $review = new Review;
        $review->product_id = $input['product_id'];
        $review->author_id = $input['author_id'];
        $review->author_name = $input['author_name'];
        $review->body = $input['body'];
        $review->rating = $input['rating'];
        $review->save();

        $averageRating = Review::where('product_id', $input['product_id'])->avg('rating');
        $reviewsCount = Review::where('product_id', $input['product_id'])->count();
        
        $product = $productTypes[$input['productType']];
        $product->reviews_count = $reviewsCount;
        $product->rating = round($averageRating, 2);
        $product->save();
        return $input;
        return redirect("showProducts/{$input['productType']}/{$input['product_id']}")
            ->with('message', 'Спасибо, Ваш отзыв успешно добавлен!')->with('class', 'alert-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(string $id, Request $request, Review $review)
    {
        $input = Request::all();

        $productTypes = [
            'smartphone' => Smartphone::findOrFail($input['product_id']),
            'tv' => Tv::findOrFail($input['product_id'])
        ];

        $review = Review::findOrFail($id);
        $review->body = $input['body'];
        $review->rating = $input['rating'];
        $review->save();
        
        $averageRating = Review::where('product_id', $input['product_id'])->avg('rating');
        $reviewsCount = Review::where('product_id', $input['product_id'])->count();
        
        $product = $productTypes[$input['productType']];
        $product->reviews_count = $reviewsCount;
        $product->rating = round($averageRating, 2);
        $product->save();
        return $input;
        return redirect("showProducts/{$input['productType']}/{$input['product_id']}")
            ->with('message', 'Спасибо, Ваш отзыв успешно обновлен!')->with('class', 'alert-success');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id, Review $review)
    {
        $input = Request::all();

        $productTypes = [
            'smartphone' => Smartphone::findOrFail($input['product_id']),
            'tv' => Tv::findOrFail($input['product_id'])
        ];

        $review = Review::findOrFail($id);
        $review->forceDelete();

        $averageRating = Review::where('product_id', '=', $input['product_id'])->avg('rating');
        $reviewsCount = Review::where('product_id', '=', $input['product_id'])->count();

        $product = $productTypes[$input['productType']];
        $product->reviews_count = $reviewsCount;
        $product->rating = round($averageRating, 2);
        $product->save();
        return $input;
        return redirect("showProducts/{$input['productType']}/{$input['product_id']}")
            ->with('message', 'Спасибо, Ваш отзыв успешно удален!')->with('class', 'alert-danger');;
    }
}
