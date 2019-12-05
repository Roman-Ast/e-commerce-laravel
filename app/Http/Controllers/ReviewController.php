<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Smartphone;
use App\TV;
use Request as StaticallyRequest;

class ReviewController extends Controller
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
        $input = $request->all();
        
        $review = new Review;
        $review->product_id = $input['product_id'];
        $review->author_id = $input['author_id'];
        $review->author_name = $input['author_name'];
        $review->body = $input['body'];
        $review->rating = (integer)$input['rating'];
        
        $review->save();
        
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
    public function update(Request $request, Review $review)
    {
        $input = $request->all();
        
        $reviewFromDB = Review::findOrFail($review['id']);
        $reviewFromDB->body = $input['body'];
        $reviewFromDB->rating = $input['rating'];
        $reviewFromDB->save();
        //return $input;
        return redirect("showProducts/{$input['productType']}/{$input['product_id']}")
            ->with('message', 'Спасибо, Ваш отзыв успешно обновлен!')->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $input = StaticallyRequest::all();
        
        $reviewFromDB = Review::findOrFail($review['id']);
        $reviewFromDB->delete();

        return redirect("showProducts/{$input['productType']}/{$input['product_id']}")
            ->with('message', 'Спасибо, Ваш отзыв успешно удален!')->with('class', 'alert-danger');
    }
}
