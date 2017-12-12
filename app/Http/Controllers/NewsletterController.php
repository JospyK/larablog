<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use App\User;
use Purifier;
use Session;
use Image;
use Storage;
use Sentinel;
use Mail;
use App\Subscriber;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Newsletter::all();
        return view('dashboard.newsletter.index')->withNews($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        return view('dashboard.newsletter.create')->withUsers($users);
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
            'subject' => 'required',
            'body' => 'required'
        ));

        //store in the database
        $new = new Newsletter;
        $new ->subject = $request -> subject;
        $new ->body = Purifier::clean($request -> body);
        $new ->user_id = Sentinel::getUser()->id;

        $new -> save();

        Session::flash('success', 'The new was successfully update!!');

        //redirect to the show page
        return redirect()->route('newsletter.show', $new->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = Newsletter::find($id);
        return view('dashboard.newsletter.show')->withNew($new);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function diffuse($id)
    {
        $new = Newsletter::find($id);
        $receivers = Subscriber::all();
        foreach ($receivers as $receiver) {
            $this->sendEmail($receiver, $new);
        }
        return view('dashboard.newsletter.edit')->withNew($new);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = Newsletter::find($id);
        return view('dashboard.newsletter.edit')->withNew($new);
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
        $new = Newsletter::find($id);
        $this->validate($request, array(
            'subject' => 'required',
            'body' => 'required'
        ));
        
        $new = Newsletter::findOrFail($id);
        $new ->subject = $request -> input('subject');
        $new ->body = Purifier::clean($request -> input('body'));
        $new ->save();

        Session::flash('success', 'The new was successfully saved!!');
        //redirect to the show page
        return redirect()->route('newsletter.show', $new->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function sendEmail($receiver, $new)
    {
        Mail::send('emails.newsletter', [
            'receiver' => $receiver,
            'new' => $new],
            function($message) use ($receiver, $new) {
                $message -> to($receiver->email);
                $message -> subject($new->subject);
        });
    }
}
