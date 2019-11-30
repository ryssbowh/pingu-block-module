<?php

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group prefixed with admin which
| contains the "web" middleware group and the permission middleware "can:access admin area".
|
*/

Route::get('blocks', ['uses' => 'BlocksAdminController@index'])
    ->middleware('perm:manage blocks')
    ->name('block.admin.blocks');