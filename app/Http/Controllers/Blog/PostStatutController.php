<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Sentinel;
use Notification;
use App\Post;

class PostStatutController extends Controller
{
	public function postAccept($id){
		$post = Post::find($id);
		$post -> statut = 'success';
        $post -> edit_message = "This post is accepted"; 
		$post ->save();

        $user = Sentinel::getUser();
        $post->user->notify(new \App\Notifications\NewPostNotification($post));

        Session::flash('success', 'The blog post is accepted!!');

		return redirect()->route('posts.show', $post->id);
	}

	public function postRefuse(Request $request, $id){
		          //validate data
        $this->validate($request, array(
            'raisons' => 'required|min:5|max:255'
        ));

		$post = Post::find($id);
		$post ->statut = 'danger';
    	$post ->edit_message = $request ->raisons;
		$post ->save();

//        Session::flash('error', 'The blog post is refused!!');

		return redirect()->route('posts.show', $post->id)->withErrors('The blog post is refused!!');
	}

    public function askForEdit(Request $request, $id)
    {
        $this->validate($request, array(
            'description' => 'required|min:5|max:255'
        ));

    	$post = Post::find($id);
    	$post ->statut = 'info';
    	$post ->edit_message = $request ->description;
		$post ->save();

        Session::flash('success', 'Edit request send!!');

		return redirect()->route('posts.show', $post->id);
    }
}
