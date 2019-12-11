<?php

namespace App\Http\Controllers;

use App\WishList;
use App\Product;
use Illuminate\Http\Request;
use Session;

class WishListController extends Controller
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
        if (\Auth::user()) {
            $userId = \Auth::user()->id;
            $cart = \Cart::session($userId);
            $cart->remove($request['id']);
            
            $product = Product::findOrFail($request['id']);
            $oldWishList = Session::has('wishList') ? Session::get('wishList') : null;
            $wishList = new WishList($oldWishList);
            $wishList->add($product, $product->id);

            $request->session()->put('wishList', $wishList);
    
            return redirect()->route('cart.index')
                ->with('message', 'Товар перемещен в список желаемых!')
                ->with('class', 'alert-success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function show(WishList $wishList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function edit(WishList $wishList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WishList $wishList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        if (\Auth::user()) {
            $wishList = Session::get('wishList');
            
            $wishList->remove($id);
            
            return redirect()->route('cart.index')
                ->with('message', 'Товар удален из списка желаемых!')
                ->with('class', 'alert-success');
        }
    }

    public function clear()
    {
        //
    }
}
