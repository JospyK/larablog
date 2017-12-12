<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //displays tags
        $tags = Tag::all();
        return view('dashboard.blog.tags.index')-> withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array('name' => 'required|max:255'));

        $tag= new Tag;
        $tag->name = $request->name;
        $tag->save();
        session::flash('success', $request->name.' has been added successfully ');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag=Tag::find($id);
        return view('dashboard.blog.tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag=Tag::find($id);
        return view('dashboard.blog.tags.edit')->withTag($tag);
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
        $this->validate($request, array('name' => 'required|max:255'));

        $tag= Tag::find($id);
        $tag->name = $request->name;
        $tag->save();

        session::flash('success', $request->name.' has been updated successfully ');
        return redirect()->route('tags.show', $id);
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        return view("dashboard.blog.tags.delete")->withTag($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        
        $tag->posts()->detach();
        $tag -> delete();

        Session::flash('success', 'The tag was successfully deleted!!');

        //redirect to the show page
        return redirect()->route('tags.index');
    }
}
