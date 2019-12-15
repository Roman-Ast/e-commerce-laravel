<?php

namespace App\Http\Controllers;

use App\CheckOut;
use App\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = \Auth::user()->id;
        $cartContent = \Cart::session($userId)->getContent();
            
        $itemsInCart = [];
        foreach ($cartContent as $cartItem) {
            $itemsInCart[] = Product::findOrFail($cartItem['id'])->toArray();
        }
        $sorteditemsInCart = collect($itemsInCart)->sortBy('brand')->all();

        return view('layouts.checkout', [
            'itemsInCart' => $sorteditemsInCart,
            'cartContent' => $cartContent,
            'cartTotalPrice' => \Cart::session($userId)->getTotal()
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
        //4242 4242 4242 4242
        $cartCollection = \Cart::session(\Auth::user()->id)->getContent();
        $contents = $cartCollection->map(function($item) {
            return $item->name . ': ' . $item->quantity;
        })->values()->toJson();
        
        try {
            \Stripe::setApiKey('sk_test_ohNr13FpA1ENUMTXaMrCrzMJ00whWfiHsJ');
            
            $charge = \Stripe::charges()->create([
                'amount' => \Cart::session(\Auth::user()->id)->getTotal() / 384.62,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'receipt_email' => $request['email'],
                'description' => 'Order',
                'metadata' => [
                    'contents' => $contents,
                    'total_quantity' => \Cart::session(\Auth::user()->id)->getTotalQuantity()
                ]
            ]);
            
            \Cart::session(\Auth::user()->id)->clear();
            //SUCCESSFULL
            return redirect()->route('paymentconfirmation.index')
                ->with('success_message', 'Спасибо, оплата прошла успешно!')
                ->with('class', 'alert-success');
        } catch (\CardErrorException $error) {
            return back()->with('error_message', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function show(CheckOut $checkOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckOut $checkOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckOut $checkOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckOut  $checkOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckOut $checkOut)
    {
        //
    }
}
