<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Purifier;
use Session;
use Image;
use Storage;
use Sentinel;
use Notification;

class PostController extends Controller
{

    public function all()
    {
        if(Sentinel::getUser()->roles()->first()->slug == "admin")
            $posts = Post::orderBy('id', 'desc')->get();
        else
            $posts = Post::where('statut', '=', 'success')->orderBy('id', 'desc')->get();
        
        return view('dashboard.blog.posts.all')->withPosts($posts);
    }


    public function index()
    {
        $posts = Post::where('user_id', '=', Sentinel::getUser()->id)->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.blog.posts.index')->withPosts($posts);
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();
        return view('dashboard.blog.posts.trashed')->withPosts($posts);
    }

    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();

        if($categories->count()==0){
            Session::flash('info', 'There is actually no categories. You must have a category before attempting to create a post.');
            return redirect()->route('categories.index');
        }
        return view('dashboard.blog.posts.create')->withCategories($categories)->withTags($tags);
    }

    public function store(Request $request)
    {
        //validate data
        $this->validate($request, array(
            'title' => 'required|max:255',
            #'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'description' => 'required',
            'body' => 'required',
            'image' => 'sometimes|image'
        ));

        //store in the database
        $post = new Post;
        $post ->title = $request -> title;
        $post ->slug = str_slug($request -> title);
        $post ->category_id = $request -> category_id;
        $post ->description = $request -> description;
        $post ->body = Purifier::clean($request -> body);
        $post ->user_id = Sentinel::getUser()->id;
        $post ->edit_message = "This post has not be treated yet"; 

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('img/post_image/'.$filename);
            Image::make($image)->resize(1000, 600)->save($location);

            $post->image = $filename;
        }

        $post -> save();
        $post -> tags() ->sync($request->tags, false);

        Session::flash('success', 'The blog post was successfully update!!');
        return redirect()->route('posts.show', $post->id);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('dashboard.blog.posts.show')->withPost($post);
    }

    public function edit($id)
    {
        $post = Post::where([['id', '=', $id],['user_id', '=', Sentinel::getUser()->id]])->first();
        $categories=Category::all();
        $tags=Tag::all();
        return view('dashboard.blog.posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    }

    public function update(Request $request, $id)
    { 
        $this->validate($request, array(
            'title' => 'required|max:255',
            #'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id' => 'required|integer',
            'description' => 'required',
            'body' => 'required',
            'image' => 'image'
        ));
        
        $post = Post::where([['id', '=', $id],['user_id', '=', Sentinel::getUser()->id]])->first();
        $post ->title = $request -> input('title');
        $post ->slug =  str_slug($request -> input('title'));
        $post ->category_id = $request -> input('category_id');
        $post ->description = $request -> input('description');
        $post ->body = Purifier::clean($request -> input('body'));
        $post ->statut = 'warning';
        $post ->edit_message = "This post has not be treated yet"; 

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('img/post_image/'.$filename);
            Image::make($image)->resize(1000, 600)->save($location);
            $oldFilename = $post->image;

            $post->image = $filename;
            Storage::delete($oldFilename);
        }

        $post ->save();
        if (isset($request->tags))
            $post -> tags() ->sync($request->tags);
        else
            $post -> tags() ->sync(array());

        Session::flash('success', 'The blog post was successfully saved!!');
        return redirect()->route('posts.show', $post->id);
    }

    /* move the ressource to trash*/
    public function destroy($id)
    {
        $post = Post::withTrashed()->where([['id', '=', $id],['user_id', '=', Sentinel::getUser()->id]])->first();
        $post -> delete();
        
        Session::flash('success', 'The blog post was successfully deleted!!');
        return redirect()->route('posts.index');
    }

    /* permanently delete the ressource*/
    public function kill($id)
    {
        $post = Post::withTrashed()->where([['id', '=', $id],['user_id', '=', Sentinel::getUser()->id]])->first();

        $post->tags()->detach();
        Storage::delete($post->image);
        $post->forceDelete();

        Session::flash('success', 'The blog post was successfully deleted!!');
        return redirect()->back();
    }

    /* restore the ressource*/
    public function restore($id)
    {
        $post = Post::withTrashed()->where([['id', '=', $id],['user_id', '=', Sentinel::getUser()->id]])->first();
        $post->restore();

        Session::flash('success', 'Post successfully restored!!');
        return redirect()->route('posts.show', $post->id);
    }
}