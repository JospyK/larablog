<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\Tag;
use App\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function getDashboardIndex(){
        $data = [
            "allPosts" => Post::all(),
            "acceptedPosts" => Post::all()->where('statut', '=', 'success')->count(),
            "allCategories" => Category::all()->count(),
            "allTags" => Tag::all()->count(),
            "allUsers" => User::all()->count(),
            "lastPosts" => Post::where('statut', '=', 'success')->orderBy('updated_at', 'desc')->limit(5)->get(),
            "lastUsers" => User::all(),
        ];
        return view("dashboard.pages.index")->withData($data);
    }
}
