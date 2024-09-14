<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebSchoolController extends ExtController
{
    public function index(){
        $schools = School::query()
                ->get()
                ->toArray();
        return $this->send_success($schools);
    }
    
    public function show($id = 0){
        $schools = School::query()
                ->where("id", "=", $id)
                ->get()
                ->toArray();
        return $this->send_success($schools);
    }
    
    public function user_show($id = 0){
        $schools = School::query()
                ->where("id", "=", User::query()
                                    ->where("id", "=", $id)
                                    ->get()
                                    ->pluck("school_id"))
                ->get()
                ->pluck("name")
                ->toArray()[0];
        return $this->send_success($schools);
    }
}
