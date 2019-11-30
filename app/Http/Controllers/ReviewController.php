<?php

namespace App\Http\Controllers;

use App\Review;
use Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reviews.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = Request::all();
        $review = new Review;
        $review->product_id = $input['product_id'];
        $review->author_id = $input['author_id'];
        $review->author_name = $input['author_name'];
        $review->body = $input['body'];
        $review->save();
        //return $input;
        return redirect("showProducts/{$input['productType']}/{$input['product_id']}");
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
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        
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

        $review = Review::find($id);
        $review->body = $input['body'];
        $review->save();
        
        return redirect("showProducts/{$input['productType']}/{$input['product_id']}");
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

        $review = Review::find($id);
        $review->forceDelete();

        return redirect("showProducts/{$input['productType']}/{$input['product_id']}");
    }
}
