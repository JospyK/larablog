<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use App\Post;
use Session;

class PagesController extends Controller{

    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->limit(10)->get();
        return view("visitorspages.welcome")->withPosts($posts);
    }   

    public function getAdminIndex(){
        $posts = Post::orderBy('created_at', 'desc')->limit(10)->get();
        return view("dashboard.pages.index")->withPosts($posts);
    }

    public function getAdminTest(){
        return view("dashboard.test");
    }  

    public function getTableTest(){
        return view("dashboard.pages.table");
    }    

    public function getTimelineTest(){
        return view("dashboard.pages.timeline");
    }    

    public function getCalendarTest(){
        return view("dashboard.pages.calendar");
    } 

    public function getProfileTest(){
        return view("dashboard.pages.profile");
    }    

    public function getPaceTest(){
        return view("dashboard.pages.pace");
    }    

    public function getChatTest(){
        return view("dashboard.pages.chat");
    } 

    public function getNotificationTest(){
        return view("dashboard.mailbox.timeline");
    }     

    public function getAbout(){
    	$first = "Jospy";
    	$last = "GOUDALO";
    	$full = $first." ".$last;
    	$data["fullname"] = $full;
    	$data["email"] = "jg@gmail.com";
    	return view("visitorspages.about")->withData($data);
    }

    public function getContact(){
        return view("visitorspages.contact");
    }

    public function postContact(Request $request){
    	$this->validate($request, array(
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required|min:15'
            ));

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => env('APP_NAME').' Contact Form | '.$request->subject,
            'bodyMessage' => $request->message
            );

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message -> from($data['email']);
            $message -> to("jospygoudalo@gmail.com");
            $message -> subject($data['subject']);

        });

        Session::flash('success', 'Your message has been sent successfully!');

        return redirect("/");
    }
}
