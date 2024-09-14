<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiReviewController;
use App\Http\Controllers\Api\ApiDestinationController;
/*
Route::get('/users', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
Route::prefix('/users')
->controller(ApiUserController::class)
->group(function(){
    Route::get('/', 'index')->middleware('auth:sanctum');
    Route::get('/show', 'show')->middleware('auth:sanctum');
    Route::post('/login', 'login');
    Route::post('register', 'register');
    Route::put('/edit-profile', 'edit-profile')->middleware('auth:sanctum');
    Route::put('/edit_password', 'edit_password')->middleware('auth:sanctum');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
    Route::delete('delete', 'delete')->middleware('auth:sanctum');
});

Route::prefix('/destinations')
->controller(ApiDestinationController::class)
->group(function(){
    Route::get('/', 'index');
    Route::get('/index_detailed', 'index_detailed');
    Route::get('/show/{id}', 'show');
    Route::get('/search', 'search');
});

Route::prefix('/reviews')
->controller(ApiReviewController::class)
->group(function(){
    Route::get('/', 'index');
    Route::get('/show_dest/{destination_id}', 'show_destination');
    Route::put('/create/{destination_id}', 'create');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'delete');
});


Route::post('/', function () {
    return "Test";
});