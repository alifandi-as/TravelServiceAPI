<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebNotificationController extends ExtController
{
    /*
    public function user_index($id){
        $schools = Notification::query()
                ->where("id", "=", User::query()
                                    ->where("id", "=", $id)
                                    ->get()
                                    ->pluck("id"))
                ->get()
                ->toArray();
        return $this->send_success($schools);
    }
    */

    
    public function user_index(){
        $notifications = Notification::query()
                ->where("recipient_id", "=", auth()->id())
                ->get()
                ->toArray();
        return $this->send_success($notifications);
    }
    
    public function send($recipient_id){
        Notification::create([
            "sender_id" => auth()->id(),
            "recipient_id" => $recipient_id
        ]);
        return redirect("/kelasku/view/$recipient_id")->with("message", "Colek berhasil");
    }
}
