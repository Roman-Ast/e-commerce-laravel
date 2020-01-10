<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Review;
use DB;
use App\Comment;
use App\MainBannerImage;

class MainPageController extends Controller
{
    public function about()
    {
        return view('about');
    }
    
    public function index()
    {
        $products = Product::all()
        ->toArray();

        $productsOnSale = Product::where('onsale', 'yes')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        $articles = DB::table('articles')
            ->where('status', 'опубликованная статья')
            ->where('image', '!=', null)
            ->inRandomOrder()
            ->limit(3)
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

        $mainBannerImages = MainBannerImage::all();
        $reviews = Review::where('rating', '>=', '3')
            ->inRandomOrder()
            ->limit(3)
            ->get()
            ->toArray();

        $users = User::all();
       
        return view('home', [
            'users' => $users,
            'products' => $products,
            'articles' => $articles,
            'timeExpired' => $timeExpired,
            'likes' => $likes,
            'comments' => $comments,
            'productsOnSale' => $productsOnSale,
            'reviews' => $reviews,
            'mainBannerImages' => $mainBannerImages
        ]);
    }
}