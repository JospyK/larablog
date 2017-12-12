<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use Session;
use Sentinel;
use Mail;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::all();
        return view('dashboard.subscribers.index')->withSubscribers($subscribers);
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
        $this->validate($request, array(
            'name' => 'required|max:255',
            'email' =>'required|email'
        ));

        $check = Subscriber::where('email', '=', $request->email);

        if ($check->count() == 0){
            $subscriber= new Subscriber;
            $subscriber->name = $request->name;
            $subscriber->email = $request->email;
            $subscriber->code = md5($request->email.' '.$request->name);
            $subscriber->save();
            session::flash('success', 'You\'re welcome '. $request->name.'. Thanks for subscribing!');
            return redirect()->back();
        }
        else{
            return redirect()->back()->withErrors('Sorry '. $request->name.'. this email adress has been taken');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }


    public function unsubscribe($email, $code)
    {
        //demander pourquoi l'utilisateur ne veut plus recevoir les news,
        //le descativer
        //et notifier a l'admin
        echo $code;
        echo $email;
        $subscriber=Subscriber::whereCode($code)->whereEmail($email)->first();
        if($subscriber->code == $code){
            echo 'egaux';
            $subscriber -> delete();
            session::flash('success', 'You\'re now unsubscribe');
            return redirect('/login');
        }
        else {
            return redirect('/home')->withErrors('Sorry you\' not a member of newsletter');
        }
    }

    public function destroy($code)
    {
        //demander pourquoi l'utilisateur ne veut plus recevoir les news,
        //le descativer
        //et notifier a l'admin

        $subscriber=Subscriber::whereCode($code)->first();
        if($subscriber->code == $code){
            echo 'egaux';
            dd($subscriber);
            $subscriber -> delete();
            session::flash('success', 'You\'re now unsubscribe');
            return redirect('/login');
        }
        else {
            return redirect('/home')->withErrors('Sorry you\' not a member of newsletter');
        }
    }
}
