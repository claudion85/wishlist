<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
class TestController extends Controller
{
    public function index(){
        $user=User::where('id',auth()->user()->id)->with('wishlist')->first();
       
        foreach($user->wishlist as $items ){
           $product=Product::whereIn('id',json_decode($items->items))->get();
           $items->items=$product;
        }
        return $user;
    }
}
