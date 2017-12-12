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

class SearchController extends Controller
{
    public function results(Request $request){

//for has any only
    	$posts = Post::where([['user_id','<>', Sentinel::getUser()->id], ['statut', '=', 'success']])
    				->Where(function ($query) use ($request){
	    				$query->where('title', 		'like', '%'.$request->q.'%')
		    				->orWhere('description','like', '%'.$request->q.'%')
		    				->orWhere('body', 		'like', '%'.$request->q.'%')
		    				->orWhere('slug', 		'like', '%'.$request->q.'%')
		    				->orWhere('statut', 	'like', '%'.$request->q.'%')
		    				->orWhere('edit_message','like','%'.$request->q.'%');
		    			})
    				->orwhere('user_id','=', Sentinel::getUser()->id)
    				->Where(function ($query) use ($request){
	    				$query->where('title', 		'like', '%'.$request->q.'%')
		    				->orWhere('description','like', '%'.$request->q.'%')
		    				->orWhere('body', 		'like', '%'.$request->q.'%')
		    				->orWhere('slug', 		'like', '%'.$request->q.'%')
		    				->orWhere('statut', 	'like', '%'.$request->q.'%')
		    				->orWhere('edit_message','like','%'.$request->q.'%');
		    			})
		    		->get();

    	$categories = Category::where('name','like', '%'.$request->q.'%')->get();

    	$tags = Tag::where('name', 		'like', '%'.$request->q.'%')->get();

		return view('dashboard.pages.dashSearch')->withSearch($request->q)->withPosts($posts)->withCategories($categories)->withTags($tags);
    }


//for guest and has_any
    public function blogresults(Request $request){

    	$posts = Post::where('title', 		'like', '%'.$request->q.'%')
    				->orWhere('description','like', '%'.$request->q.'%')
    				->orWhere('body', 		'like', '%'.$request->q.'%')
    				->orWhere('slug', 		'like', '%'.$request->q.'%')
    				->orWhere('statut', 	'like', '%'.$request->q.'%')
    				->orWhere('edit_message','like','%'.$request->q.'%')
    				->paginate(10);

    	$categories = Category::where('name','like', '%'.$request->q.'%')->get();

    	$tags = Tag::where('name', 		'like', '%'.$request->q.'%')->get();

		return view('blog.search')->withSearch($request->q)->withPosts($posts)->withCategories($categories)->withTags($tags);
    }

}
