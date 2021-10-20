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
//was causing artisan to throw an error
//In Route.php line 880:

//Unable to prepare route [api/user] for serialization. Uses Closure.
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
