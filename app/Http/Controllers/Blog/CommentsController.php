<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\RepliedToThread;
use App\Post;
use App\Comment;
use Session;
use Sentinel;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|min:5|max:2000'
            ));

        $post = Post::find($post_id);

        $comment = new Comment();
        $comment ->name = $request ->name;
        $comment ->email = $request ->email;
        $comment ->commnent = $request ->comment;
        $comment ->approuved = true;

        $comment ->post()->associate($post);
        $comment -> save();


        Session::flash ('success', 'Thanks for your comment');
        return redirect()->route('blog.single', [$post ->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view("dashboard.blog.comments.edit")->withComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'comment' => 'required|min:5|max:2000'
            ));

        $comment = Comment::find($id);
        $comment ->commnent = $request ->comment;
        $comment ->approuved = true;

        $comment -> save();

        Session::flash ('success', 'Comment was updated ');
        return redirect()->route('posts.show', [$comment->post->id]);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        return view("dashboard.blog.comments.delete")->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment -> delete();
        Session::flash ('success', 'Comment was deleted ');
        return redirect()->route('posts.show', $post_id);
    }
}
