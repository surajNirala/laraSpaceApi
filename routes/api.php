<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* Route::group(['middleware' => ['auth:jwt']], function () {
    Route::post('user', 'LoginController@user');
}); */

Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');

Route::middleware('jwt.auth')->group( function () {
	Route::post('logout','LoginController@logout');
	Route::get('user','UserController@index');
	Route::get('articles', 'ArticleController@index');
	Route::get('articles/{article}', 'ArticleController@show');
	Route::post('articles', 'ArticleController@store');
	Route::put('articles/{article}', 'ArticleController@update');
	Route::delete('articles/{article}', 'ArticleController@delete');
	// Route::resource('products', 'API\ProductController');
});
