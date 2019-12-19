<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        $this->validate($request, [
            'article_id' => 'required',
            'author_id' => 'required',
            'body' => 'required|min:3'
        ]);
        $comment = new Comment();

        $comment->article_id = $request['article_id'];
        $comment->author_id = $request['author_id'];
        $comment->author_name = $request['author_name'];
        $comment->body = $request['body'];
        $comment->save();

        return redirect()->route('articles.show', $request['article_id'])
            ->with('success_message', 'Комментарий успешно добавлен!')
            ->with('class', 'alert-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        $comment->body = $request['body'];
        $comment->save();

        return back()
            ->with('success_message', 'Комментарий успешно изменен!')
            ->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $commentForDelete = Comment::findOrFail($comment->id);
        $comment->delete();

        return back()
            ->with('success_message', 'Комментарий успешно удален!')
            ->with('class', 'alert-success');
    }
}
