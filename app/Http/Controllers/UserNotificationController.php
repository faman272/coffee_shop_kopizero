<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserNotification;

class UserNotificationController extends Controller
{
    public function index()
    {

        $notifications = UserNotification::where('user_id', auth()->user()->id)->get();

        return view('notification', compact('notifications'));
    }


    public function destroy($id)
    {
        $notification = UserNotification::find($id);
        $notification->delete();
        
        return redirect()->route('notification');
    }
}
