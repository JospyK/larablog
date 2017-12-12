<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class NotificationController extends Controller
{
    public function markAsRead(){
    	$user = Sentinel::getUser();
    	$user->unreadNotifications->markAsRead();
    }
}
