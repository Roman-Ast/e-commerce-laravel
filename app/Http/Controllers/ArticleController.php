<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = DB::table('articles')->latest()->paginate(8);
        

        $carbonTimeStamps = [];
        foreach ($articles as $articleObj) {
            $article = (array)$articleObj;
            $current = Carbon::now();
            $creation_date = Carbon::createFromDate($article['updated_at']);
            $diffInMinutes = $creation_date->diffInMinutes(Carbon::now(), false) % 60;
            $diffInHours = $creation_date->diffInHours(Carbon::now(), false) % 60;
            $diffInDays = $creation_date->diffInDays(Carbon::now(), false);
            $diffInWeeks = $creation_date->diffInWeeks(Carbon::now(), false);
            $diffInMonths = $creation_date->diffInMonths(Carbon::now(), false);
            $diffInYears = $creation_date->diffInYears(Carbon::now(), false);

            $carbonTimeStamps[$article['id']] = [
                'diffInYears' => $diffInYears,
                'diffInMonths' => $diffInMonths,
                'diffInWeeks' => $diffInWeeks,
                'diffInDays' => $diffInDays,
                'diffInHours' => $diffInHours,
                'diffInMinutes' => $diffInMinutes,
            ];
        }
        //return $carbonTimeStamps;
        $timeExpired = [];
        foreach ($carbonTimeStamps as $articleId => $articleData) {
            
            foreach ($articleData as $typeOfTimeStamp => $timeStamp) {
                if ($timeStamp > 0) {
                    $timeExpired[$articleId] = [$typeOfTimeStamp => $timeStamp];
                break;
                }
            }
            
        }
        return $timeExpired;
        return view('layouts.articles.index', [
            'articles' => $articles,
            'timeExpired' => $timeExpired
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->author_id = $request['author_id'];
        $article->author_name = $request['author_name'];
        $article->title = $request['title'];
        $article->body = $request['body'];

        $article->save();

        return redirect()->route('articles.index')
            ->with('success_message', 'Статья успешно опубликована')
            ->with('class', 'alert-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
