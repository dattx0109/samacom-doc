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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/role/user-of-role', ['as' => 'user-of-role', 'uses' => 'Role\RoleController@getListUserOfRole']);
Route::get('/report/report-referral', ['as' => 'report-referral', 'uses' => 'Report\ReferralReport@getAllJobByReferralId']);

