<?php

namespace App\Http\Controllers;

use App\Article;
use App\Like;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Route;

class ArticleController extends Controller
{
    public function getTimeStamps($articles)
    {
        $carbonTimeStamps = [];
        foreach ($articles as $article) {
            $current = Carbon::now();
            $creation_date = Carbon::createFromDate($article->updated_at);
            $diffInSeconds = $creation_date->diffInSeconds(Carbon::now(), false) % 60;
            $diffInMinutes = $creation_date->diffInMinutes(Carbon::now(), false) % 60;
            $diffInHours = $creation_date->diffInHours(Carbon::now(), false) % 60;
            $diffInDays = $creation_date->diffInDays(Carbon::now(), false);
            $diffInWeeks = $creation_date->diffInWeeks(Carbon::now(), false);
            $diffInMonths = $creation_date->diffInMonths(Carbon::now(), false);
            $diffInYears = $creation_date->diffInYears(Carbon::now(), false);

            $carbonTimeStamps[$article->id] = [
                'diffInYears' => $diffInYears,
                'diffInMonths' => $diffInMonths,
                'diffInWeeks' => $diffInWeeks,
                'diffInDays' => $diffInDays,
                'diffInHours' => $diffInHours,
                'diffInMinutes' => $diffInMinutes,
                'diffInSeconds' => $diffInSeconds,
            ];
        }
        $timeStampsForUsers = [
            'diffInHours' => 'час(-а, -ов) назад',
            'diffInYears' => 'год(-а, лет) назад',
            'diffInMonths' => 'месяц(-а, -ев) назад',
            'diffInWeeks' => 'неделю(-и) назад',
            'diffInDays' => 'день(дня, дней) назад',
            'diffInMinutes' => 'минут(-у, -ы) назад',
            'diffInSeconds' => 'секунд(-у, -ы) назад'
        ];
        
        $timeExpired = [];
        foreach ($carbonTimeStamps as $articleId => $articleData) {
            
            foreach ($articleData as $typeOfTimeStamp => $timeStamp) {
                if ($timeStamp > 0) {
                    $timeExpired[$articleId] = [$timeStampsForUsers[$typeOfTimeStamp] => $timeStamp];
                    break;
                }
            }
            
        }

        return $timeExpired;
    }

    public function saveAsDraft(Request $request)
    {
        $article = new Article();
        
        $article->author_id = $request['author_id'];
        $article->author_name = $request['author_name'];
        $article->title = $request['title'];
        $article->body = $request['body'];
        $article->status = $request['status'];

        $article->save();

        return $request;
    }

    public function updateDraft(Request $request)
    {
        $article = Article::findOrFail($request['article_id']);

        $article->title = $request['title'];
        $article->body = $request['body'];
        $article->status = $request['status'];
        $article->save();

        return $request;
    }

    public function myArticles()
    {
        $articles = DB::table('articles')
            ->where('author_name', \Auth::user()->name)
            ->latest()
            ->paginate(8);

        $timeExpired = $this->getTimeStamps($articles);

        return view('layouts.articles.index', [
            'articles' => $articles,
            'timeExpired' => $timeExpired
        ]);
    }

    public function like(Request $request)
    {
        
        $like = DB::table('likes')
            ->where('article_id', '=', $request['article_id'])
            ->where('user_id', '=', $request['user_id'])
            ->get();
        
        
        if (!empty($like->toArray())) {
            
            DB::table('likes')
            ->where('article_id', '=', $request['article_id'])
            ->where('user_id', '=', $request['user_id'])
            ->delete();
            
            $likesCountOfArticle = $like = DB::table('likes')
                ->where('article_id', '=', $request['article_id'])
                ->get()
                ->count();
            
            return json_encode([
                'likesCountOfArticle' => $likesCountOfArticle,
                'likedByMe' => false
            ]);
        }

        $like = new Like();
        $like->article_id = $request['article_id'];
        $like->user_id = $request['user_id'];
        $like->save();

        $likesCountOfArticle = $like = DB::table('likes')
            ->where('article_id', '=', $request['article_id'])
            ->get()
            ->count();
        
        return json_encode([
            'likesCountOfArticle' => $likesCountOfArticle,
            'likedByMe' => true
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = DB::table('articles')
            ->where('status', 'опубликованная статья')
            ->latest()
            ->paginate(8);
        $timeExpired = $this->getTimeStamps($articles);
        $rawlikes = DB::table('likes')->get()->toArray();
        
        $likes = [];
        foreach ($rawlikes as $key => $object) {
            if (array_key_exists($object->article_id, $likes)) {
                $likes[$object->article_id] += 1;
            } else {
                $likes[$object->article_id] = 1;
            }
        }
        
        return view('layouts.articles.index', [
            'articles' => $articles,
            'timeExpired' => $timeExpired,
            'likes' => $likes
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
        $path = $request->file('image')->store('uploads', 'public');
        
        $article = new Article();
        $article->author_id = $request['author_id'];
        $article->author_name = $request['author_name'];
        $article->title = $request['title'];
        $article->body = $request['body'];
        $article->status = $request['status'];
        $article->image = $path;

        $article->save();

        return redirect()->route('articles.myarticles')
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
        $article = Article::findOrFail($article->id);
        $likes = DB::table('likes')->where('article_id', $article->id)->get()->count();
        $likedByMe = DB::table('likes')
            ->where('user_id', \Auth::user()->id)
            ->where('article_id', $article->id)
            ->exists();
        $articles = DB::table('articles')->get();
        $timeExpired = $this->getTimeStamps($articles);
        
        return view('layouts.articles.show', [
            'likedByMe' => $likedByMe,
            'article' => $article,
            'likes' => $likes,
            'timeExpired' => $timeExpired
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $article = Article::findOrFail($article->id);
        return view('layouts.articles.edit', ['article' => $article]);
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
        $article = Article::findOrFail($article->id);

        $article->title = $request['title'];
        $article->body = $request['body'];
        $article->status = $request['status'];
        $article->save();

        return redirect()->route('articles.myarticles')
            ->with('success_message', 'Статья успешно изменена!')
            ->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article = Article::findOrFail($article->id);
        $article->destroy($article->id);

        return redirect()->route('articles.myarticles')
            ->with('success_message', 'Статья успешно удалена!')
            ->with('class', 'alert-success');
    }
}
