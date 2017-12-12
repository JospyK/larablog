<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Purifier;
use Session;
use App\User;
use App\Messages;


class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Messages::all();
        return view("dashboard.blog.chat.chat")->withMessages($messages);
    }


    public function notification($id)
    {
        $notification = Messages::where('read_at', 0)->where('receiver_id', Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        return response(['data'=>$notification], 200);
        //return view("dashboard.blog.chat.chat.compose")->with();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $this->validate($request, array(
            'message' => 'min:1|required',
        ));

        //store in the database
        $message = new Messages;
        $message->user_id  = Sentinel::getUser()->id;
        $message->message  = Purifier::clean($request->message);

        $message->save();

        //send the message object to the page
        return redirect()->route('messages.index')->withMessages($message);
    }

    public function important($id){
        echo 'bonjour';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Messages::find($id);
        $message -> delete();
        Session::flash('success', 'The message was successfully deleted!!');
        //redirect to the show page
        return redirect()->route('messages.index');
    }
}
