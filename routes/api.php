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

Route::post('/register','API\AuthController@register');
Route::post('/login','API\AuthController@login');

Route::group(['prefix' => '/',  'middleware' => 'auth:api'], function()
{
    //All the routes that belongs to the group goes here
    Route::get('products', 'ProductController@index' );

    Route::resource('wishlist',WishListController::class);
    Route::get('export_wishlist','WishListController@exportCsv');
    Route::get('test','API\TestController@index');
    Route::post('logout','API\AuthController@logout');
});