<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use Auth;
use App\WishList;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (\Auth::user()) {
            $refererUrl = $request->server('HTTP_REFERER');
            $userId = \Auth::user()->id;
            $cartContent = \Cart::session($userId)->getContent();
            
            $itemsInCart = [];
            foreach ($cartContent as $cartItem) {
                $itemsInCart[] = Product::findOrFail($cartItem['id'])->toArray();
            }
            $sorteditemsInCart = collect($itemsInCart)->sortBy('brand')->all();

            if (!Session::has('wishList')) {

                return view('cart',[
                    'itemsInCart' => $sorteditemsInCart,
                    'cartContent' => $cartContent,
                    'wishList' => null,
                    'cartTotalPrice' => \Cart::session($userId)->getTotal()
                ]);
            }
            $oldWishlist = Session::get('wishList');
            $wishList = new WishList($oldWishlist);
            
            $wishListForDisplay = [];
            foreach ($wishList->getContent() as $object) {
                $wishListForDisplay[] = $object['item']->toArray();
            }
            
            return view('cart',[
                'itemsInCart' => $sorteditemsInCart,
                'cartContent' => $cartContent,
                'wishList' => $wishListForDisplay,
                'cartTotalPrice' => \Cart::session($userId)->getTotal(),
                'refererUrl' => $refererUrl
            ]);
        } else {
            $cart = Session::get('cart');
            $itemsInCart = [];
            $refererUrl = $request->server('HTTP_REFERER');
            
            if ($cart) {
                $cartContent = $cart::getContent();
                foreach ($cartContent as $cartItem) {
                    $itemsInCart[] = Product::findOrFail($cartItem['id'])->toArray(8);
                }
            }
            $sorteditemsInCart = collect($itemsInCart)->sortBy('brand')->all();
            if (!Session::has('wishList')) {

                return view('cart',[
                    'itemsInCart' => $sorteditemsInCart,
                    'cartContent' => $cartContent,
                    'wishList' => null,
                    'cartTotalPrice' => $cart::getTotal()
                ]);
            }
            $oldWishlist = Session::get('wishList');
            $wishList = new WishList($oldWishlist);
            
            $wishListForDisplay = [];
            foreach ($wishList->getContent() as $object) {
                $wishListForDisplay[] = $object['item']->toArray();
            }

            return view('cart',[
                'itemsInCart' => $sorteditemsInCart,
                'cartContent' => $cartContent,
                'wishList' => $wishListForDisplay,
                'cartTotalPrice' => $cart::getTotal(),
                'refererUrl' => $refererUrl
            ]);
        }
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
        if (Auth::user()) {
            if (Session::has('wishList')) {
                $wishList = Session::get('wishList');
                $wishList->remove($request['id']);
            }
            $userId = \Auth::user()->id;
            
            $duplicates = \Cart::session($userId)->get($request['id']);
            
            if ($duplicates) {
                return back()
                ->with('message', 'Товар уже у Вас в корзине, если Вы хотите добавить еще один, то перейдите в корзину!')
                ->with('class', 'alert-warning');
            }
            
            $this->validate($request, [
                'id' => 'required',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric|min:1',
                'name' => 'required',
            ]);
        
            \Cart::session($userId)->add($request['id'], $request['name'], $request['price'], $request['quantity']);
            
            return redirect()->back()
                ->with('message', 'Товар добавлен в корзину!')
                ->with('class', 'alert-success');
        } else {
            $product = Product::findOrFail($request['id']);

            if (Session::has('cart')) {
                $cart = Session::get('cart');
                var_dump($cart::get($request['id']));
            } else {
                $cart = new \Cart();            
            }
            $duplicates = $cart::get($request['id']);
            
            if ($duplicates) {
                return redirect()->back()
                    ->with('message', 'Товар уже у Вас в корзине, если Вы хотите добавить еще один, то перейдите в корзину!')
                    ->with('class', 'alert-warning');
            }

            $this->validate($request, [
                'id' => 'required',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric|min:1',
                'name' => 'required',
            ]);

            $cart::add($request['id'], $request['name'], $request['price'], $request['quantity']);
            $request->session()->put('cart', $cart);

            return redirect()->back()
                    ->with('message', 'Товар добавлен в корзину!')
                    ->with('class', 'alert-success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cart)
    {
        if (Auth::user()) {
            $userId = \Auth::user()->id;
            \Cart::session($userId)
                ->update($request['id'], array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request['quantity']
                        )
                    )
                );
            
            return redirect()->route('cart.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        if (\Auth::user()) {
            $userId = \Auth::user()->id;
            $cart = \Cart::session($userId);
            $cart->remove($id);
        } else {
            $cart = Session::get('cart');
            $cart::remove($id);
        }
        return redirect()->route('cart.index')
                ->with('message', 'Товар успешно удален из корзины!')
                ->with('class', 'alert-success');
    }

    public function clear()
    {
        if (\Auth::user()) {
            $userId = \Auth::user()->id;
            $cart = \Cart::session($userId);
            $cart->clear();
        } else {
            $cart = Session::get('cart');
            $cart::clear();
        }
        return redirect()->route('cart.index')
                ->with('message', 'Корзина очищена!')
                ->with('class', 'alert-success');
    }
}
