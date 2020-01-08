<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Client;
use App\Http\Resources\Client as ClientResource;

Route::get('/{client?}', function ($client = null) {
    return view('welcome');
});

Route::get('/api/{client?}', function ($client = null) {
    return ClientResource::collection(Client::all()->load('policies')->where('name',$client));
});