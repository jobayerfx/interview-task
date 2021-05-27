<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/register', 'Auth\UserAuthController@register')->name('register');
Route::post('/login', 'Auth\UserAuthController@login')->name('login');

Route::apiResource('/role', 'RoleController')->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::get('user-list', 'Auth\UserAuthController@user_list');
    Route::get('user/{id}', 'Auth\UserAuthController@user_details');
    Route::post('assign-role', 'UserRoleController@assignRoleToUser');
    Route::get('user-role/{id}', 'UserRoleController@getRolesByUser');
    Route::get('delete-assign-role/{user_id}/{role_id}', 'UserRoleController@deleteAssignRole');
    Route::get('get-single-roles/{user_id}', 'UserRoleController@getSingleUserRoles');
    Route::post('save-edit-role', 'UserRoleController@saveUserEditRole');
});
