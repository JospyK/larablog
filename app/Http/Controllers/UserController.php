<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Tag;
use Purifier;
use Session;
use Image;
use Storage;
use Sentinel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authentication.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Sentinel::getUser($id);
        return view('dashboard.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //validate data
        $user = User::find($id);
        $this->validate($request, array(
            'last_name'  => 'alpha_dash|min:3|max:255',
            'first_name' => 'alpha_dash|min:3|max:255',
            'description'=> 'max:500',
            'image'      => 'image'
        ));
        
        $user = User::findOrFail($id);

        $user ->last_name  = $request ->last_name;
        $user ->first_name = $request ->first_name;
        $user ->description= $request ->description;
        //$user ->description = $request ->description;

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('img/user_image/'.$filename);
            Image::make($image)->resize(500, 500)->save($location);

            $oldFilename = $user->image;
            if($oldFilename != 'img/user_image/default.png')
                Storage::delete($oldFilename);

            $user->image = $filename;
        }

        $user ->save();

        Session::flash('success', 'The user was successfully updated !!');

        //redirect to the show page
        return redirect()->route('users.show', $user->id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //remplir et changer par disable($id)
    }
}
