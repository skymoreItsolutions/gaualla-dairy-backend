<?php

use App\Http\Controllers\ProductContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get("v1/allproduct",[ProductContoller::class,"getallProduct"]);
Route::get("v1/allproduct-type",[ProductContoller::class,"getallProductType"]);
Route::get("v1/product/{type}",[ProductContoller::class,"getproductbyType"]);
Route::get("v1/allblog",[ProductContoller::class,"getallBlog"]);
Route::get("v1/blog/{slug}",[ProductContoller::class,"getBlog"]);

Route::post("v1/senquery",[ProductContoller::class,"sendQuery"]);
