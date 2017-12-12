<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Sentinel;
use Mail;
use Session;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(){
    	return view('authentication.forgot-password');
    }

    
    public function postForgotPassword(Request $request)
    {
    	$user = User::byEmail($request->email);

    	if (count($user) == null){
            Session::flash('success', 'Email Sent.');
            return redirect()->back();
        }
        $sentinelUser= Sentinel::findById($user->id);
    	$reminder = Reminder::exists($sentinelUser) ? : Reminder::create($sentinelUser);
        $this->sendEmail($user, $reminder->code);
    }

    
    public function resetPassword($email, $resetCode)
    {
		$user = User::byEmail($email);
    	$sentinelUser= Sentinel::findById($user->id);
		if(count($user)==0)
			abort(404);
		if($reminder = Reminder::exists($sentinelUser))
		{
			if($resetCode == $reminder->code)
				return view('authentication.reset-password');
			else
				return redirect('/');
		}
		else
			return redirect('/');
    }

    
    public function postResetPassword(Request $request, $email, $resetCode)
    {
    	$this->validate($request, [
    		'password' => 'confirmed|required|min:5|max:10',
    		'password_confirmation' => 'required|min:5|max:10',
    		]);

    	$user = User::byEmail($email);
    	$sentinelUser= Sentinel::findById($user->id);
		if(count($user)==0)
			abort(404);
		if($reminder = Reminder::exists($sentinelUser))
		{
			if($resetCode == $reminder->code)
			{
				Reminder::complete($sentinelUser, $resetCode, $request->password);
				Session::flash('success', 'Please login with your new password.');
				return redirect('/login');
			}
			else
				return redirect('/');
		}
		else
			return redirect('/');
    }

    
    private function sendEmail($user, $code)
    {
        Mail::send('emails.forgot-password', [
            'user' => $user,
            'code' => $code], 
            function($message) use ($user) {
                $message ->to($user->email);
                $message -> subject(htmlspecialchars($user->first_name)." Restaurer votre mot de passe.");
        });
        Session::flash('success', 'Email Sent.');
    }
}
