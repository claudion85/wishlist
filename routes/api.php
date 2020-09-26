<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/* login and register routes */
Route::post('/register','API\AuthController@register');
Route::post('/login','API\AuthController@login');


/* Authenticated routes */
Route::group(['prefix' => '/',  'middleware' => 'auth:api'], function()
{
    /*product's routes*/
    Route::get('products', 'ProductController@index' );

    /* declare the resource route for CRUD operations in WishListController*/
    Route::resource('wishlist',WishListController::class);

    
    /* logout route */
    Route::post('logout','API\AuthController@logout');
});