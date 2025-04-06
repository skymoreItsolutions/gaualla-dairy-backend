<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Producttype;
use App\Models\Query;
use Illuminate\Http\Request;

class ProductContoller extends Controller
{
    //

public function getallProduct(){
    $product= Product::all();

    return $product;
}
public function getallProductType(){
    $product= Producttype::all();

    return $product;
}

public function getproductbyType(string $type){
 
    $product = Product::where("type",$type)->get();

    if(!$product){
        return response()->json(["success"=>false,"message"=>"no product found"]);
    }

    return response()->json(["success"=>true,"product"=>$product]);




}

public function getallBlog(){
    $blog=Blog::all();
    return $blog;
}
public function getBlog(string $slug){
    $blog=Blog::where("slug",$slug)->first();
    return $blog;
}





public function sendQuery(Request $request)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'email'       => 'required|email|max:255',
        'phonenumber' => 'required|string|max:20',
        'message'     => 'required|string',
    ]);

    Query::create($validated);

    return response()->json([
        'message' => 'Your query has been submitted successfully!'
    ]);
}

}
