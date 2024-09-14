<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UploadManager;
use App\Http\Controllers\WebUserController;
use App\Http\Controllers\WebSchoolController;
use App\Http\Controllers\Api\User\ApiUserController;
use App\Http\Controllers\WebNotificationController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('public/home');
})->middleware('guest');

Route::get("/test", function(){
    return view("test");
});

Route::get('/login', function(){
    return view('public/login');
})->name('login')->middleware('guest');

Route::get('/register', function(){
    $school_cont = new WebSchoolController;
    return view('public/register', ["schools" => null]);
})->middleware('guest');

Route::get('/upload', [UploadManager::class, "upload"])->name('upload');
Route::post('/upload', [UploadManager::class, "uploadPost"])->name('upload.post');

Route::prefix('kelasku')
->group(function(){
    Route::get('/', function(){
        $user_cont = new WebUserController;
        $school_cont = new WebSchoolController;
        return view("user/kelasku", ["students" => $user_cont->index(),
                                     "schools" => $school_cont->index()]);
    })->name('home');
    Route::get('/search/', function(Request $request){
        $user_cont = new WebUserController;
        $school_cont = new WebSchoolController;
        return view("user/kelasku", ["students" => $user_cont->search($request),
                                     "schools" => $school_cont->index()]);
    })->name('home');
    Route::get('/view/{id}', function($id){
        $user_cont = new WebUserController;
        $school_cont = new WebSchoolController;
        return view("user/view", ["student" => $user_cont->show($id),
                                  "school" => $school_cont->user_show($id)]);
    });
});

Route::get('/notifications', function(){
    $user_cont = new WebUserController;
    $notif_cont = new WebNotificationController;
    return view('user/notification', ["students" => $user_cont->index(),
                                      "notifications" => $notif_cont->user_index()]);
});

Route::prefix('/process')
->controller(WebUserController::class)
->group(function(){
    Route::post('/login', function(Request $request){
        return dd($request->image);
    });
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
    Route::post('edit/profile', 'edit_profile');
    Route::post('edit/password', 'edit_password');
    Route::post('delete', 'delete');
});

Route::get("/process/poke/{id}", function($id){
    $notif_cont = new WebNotificationController;
    return $notif_cont->send($id);
});

Route::prefix("/profile")
->group(function(){
    Route::get('/', function(){
        $school_cont = new WebSchoolController;
        return view("user/profile", ["school" => $school_cont->user_show(auth()->id())]);
    });
    Route::get('/edit', function(){
        $school_cont = new WebSchoolController;
        return view('user/edit_profile', ["schools" => $school_cont->index()]);
    });
    Route::get('/edit/password', function(){
        return view("user/edit_password");
    });
});
/*
Route::post('/process/register', function(Request $request){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($request->image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($request->register)) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }
    return dd($request->register);
    
});
*/