<?php

namespace App\Http\Controllers;

use App\WishList;
use App\User;
use App\Product;
use App\Exports\WishListExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writer; 
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return wishlists of logged user
        $user=User::where('id',auth()->user()->id)->with('wishlist')->first();
        
        /*FOR EACH ITEM FIELD (comma separated product ids) gets the product object and replaces it */
        foreach($user->wishlist as $items ){
           $product=Product::whereIn('id',json_decode($items->items))->get();
           $items->items=$product;
        }
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validedData= $request->validate([
            'wishlist_name'=>'required',
            'items'=>'required'
        ]);
        $wishlist=new WishList();
        $wishlist->wishlist_name=$request->wishlist_name;
        $wishlist->user_id=auth()->user()->id;
        $wishlist->items=json_encode(explode(',',$request->items));
        $response=$wishlist->save();
        if($response){
            return response()->json(['message'=>'item added successfully']);
        }
        else{
            return response(['message'=>'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function show(WishList $wishList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function edit(WishList $wishList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WishList $wishList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function destroy(WishList $wishList)
    {
        //
    }


    public function exportCsv(){

        /*return a csv from WishListExport collection and store it in local disk */

        \Config::set("excel.exports.csv.delimiter",';');
        
        return Excel::store(new WishListExport,'wishlist2_'.date('Y-m-d H-i-s').'.csv');
    }
}
