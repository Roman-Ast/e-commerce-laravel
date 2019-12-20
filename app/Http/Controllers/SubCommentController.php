<?php

namespace App\Http\Controllers;

use App\SubComment;
use Illuminate\Http\Request;

class SubCommentController extends Controller
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
            'comment_id' => 'required',
            'author_id' => 'required',
            'sub-comment-body' => 'required|min:3'
        ]);
        $subcomment = new SubComment();

        $subcomment->comment_id = $request['comment_id'];
        $subcomment->author_id = $request['author_id'];
        $subcomment->author_name = $request['author_name'];
        $subcomment->body = $request['sub-comment-body'];
        $subcomment->save();

        return back()
            ->with('success_message', 'Ответ успешно добавлен!')
            ->with('class', 'alert-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubComment  $subComment
     * @return \Illuminate\Http\Response
     */
    public function show(SubComment $subComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubComment  $subComment
     * @return \Illuminate\Http\Response
     */
    public function edit(SubComment $subComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubComment  $subComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubComment $subComment)
    {
        $subComment = SubComment::findOrFail($request['subcomment_id']);
        $subComment->body = $request['body'];
        $subComment->save();

        return redirect()->route('articles.show', $request['article_id'])
            ->with('success_message', 'Ответ успешно изменен!')
            ->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubComment  $subComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SubComment $subComment)
    {
        $subCommentForDelete = SubComment::findOrFail($request['subcomment_id']);
        $subCommentForDelete->delete();

        return redirect()->route('articles.show', $request['article_id'])
            ->with('success_message', 'Ответ успешно удален!')
            ->with('class', 'alert-success');
    }
}
