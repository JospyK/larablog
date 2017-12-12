<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Session;

class CategoryController extends Controller
{

    public function index()
    {
        //displays categories
        $categories = Category::all();
        return view ('dashboard.blog.categories.index')-> withCategories($categories);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
        	'name' => 'required|max:255'));
        $category= new Category;
        $category->name = $request->name;
        $category->save();
        session::flash('success', $request->name.' has been added successfully ');
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category=Category::find($id);
        return view('dashboard.blog.categories.show')->withcategory($category);
    }


    public function edit($id)
    {
        $category=Category::find($id);
        return view('dashboard.blog.categories.edit')->withcategory($category);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|max:255'));
        $category= Category::find($id);
        $category->name = $request->name;
        $category->save();
        
        session::flash('success', $request->name.' has been updated successfully ');
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        foreach($category->posts as $post){
            $post->forceDelete();  
        }
        $category -> delete();

        Session::flash('success', 'The category was successfully deleted!!');
        return redirect()->route('categories.index', $category->id);
    }
}