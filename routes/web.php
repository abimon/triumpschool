<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/documentation',function(){
    if(request('phn')=='0752557823'){
        return view('api-documentation');
    }else{
        return response()->json(['message'=>'Unauthorized'],401);
    }
});
