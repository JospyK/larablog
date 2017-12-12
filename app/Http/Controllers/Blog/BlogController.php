<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;

class BlogController extends Controller
{
	public function getIndex() {
    	$posts = Post::where('statut', 'success')->orderBy('updated_at', 'desc')->paginate(10);
		$categories = Category::all();
		$tags = Tag::all();
		
		return view('blog.index')->withPosts($posts)->withCategories($categories)->withTags($tags);
	}

	public function getUsers() {
		$users = User::paginate(10);
		
		return view('blog.users.index')->withUsers($users);
	}
    
    public function getCategory($category){
    	$category = Category::where('name', '=', $category)->first();
    	$posts = Post::where('category_id', '=', $category->id)->where('statut', 'success')->orderBy('updated_at', 'desc')->paginate(10);
		$categories = Category::all();
		$tags = Tag::all();

    	
    	return view('blog.category')->withPosts($posts)->withCategory($category)->withCategories($categories)->withTags($tags);
    }
    
    public function getTag($tag){
    	$tag = tag::where('name', '=', $tag)->first();
    	$posts = $tag->posts()->where('statut', '=', 'success')->orderBy('updated_at', 'desc')->paginate(10);
		$categories = Category::all();
		$tags = Tag::all();
    	
    	return view('blog.tag')->withPosts($posts)->withTag($tag)->withTags($tags)->withCategories($categories);		
    }

    public function getSingle($slug) {
		$post = Post::where('slug', '=' , $slug)->first();
		$propositions = Post::where('id', '<>' , $post->id)->where('category_id', '=' , $post->category->id)->orderBy('updated_at', 'desc')->take(3)->get();
		$sameauthorposts = Post::where('user_id', '=' , $post->user->id)->where('id', '<>' , $post->id)->orderBy('updated_at', 'desc')->take(5)->get();
		return view('blog.single')->withPost($post)->withPropositions($propositions)->withSameauthorposts($sameauthorposts);
	}

    public function getUserPosts($id){
		$user = User::where('id', '=' , $id)->first();
		$posts = Post::where('user_id', '=' , $user->id)->where('statut', '=', 'success')->orderBy('updated_at', 'desc')->paginate(10);
    
    	$categories = Post::where('user_id', '=' , $user->id)->where('statut', '=', 'success')
    					->join('categories', 'category_id', '=', 'categories.id')
    					->select('categories.id', 'categories.name')    					
    					->groupBy('categories.id',  'categories.name')
    					->get();

    	$tags = Post::where('user_id', '=' , $user->id)->where('statut', '=', 'success')
    					->join('post_tag', 'posts.id', '=', 'post_tag.post_id')
    					->join('tags', 'tag_id', '=', 'tags.id')
    					->select('tags.id', 'tags.name')    					
    					->groupBy('tags.id',  'tags.name')
    					->get();
    	
    	return view('blog.users.single')->withPosts($posts)->withUser($user)->withCategories($categories)->withTags($tags);
	}   
}
