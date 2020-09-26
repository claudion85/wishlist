<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable=[
        'wishlist_name',
        'user_id',
        'items'
    ];



}
