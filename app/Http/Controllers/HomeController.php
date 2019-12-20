<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use DB;
use App\Http\Controllers\ArticleController;
use App\Comment;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home');
    }

    public function main()
    {
        $productsOnSale = Product::where('onsale', 'yes')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        $articles = DB::table('articles')
            ->where('status', 'опубликованная статья')
            ->where('image', '!=', null)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        $timeExpired = ArticleController::getTimeStamps($articles);
        $rawLikes = DB::table('likes')->get()->toArray();
        $rawComments = Comment::all()->toArray();
        
        $comments = [];
        foreach ($rawComments as $comment) {
            if (array_key_exists($comment['article_id'], $comments)) {
                $comments[$comment['article_id']] += 1;
            } else {
                $comments[$comment['article_id']] = 1;
            }
        }
        
        $likes = [];
        foreach ($rawLikes as $key => $object) {
            if (array_key_exists($object->article_id, $likes)) {
                $likes[$object->article_id] += 1;
            } else {
                $likes[$object->article_id] = 1;
            }
        }

        return view('home', [
            'articles' => $articles,
            'timeExpired' => $timeExpired,
            'likes' => $likes,
            'comments' => $comments,
            'productsOnSale' => $productsOnSale
        ]);
    }
}
