<?php

use Pingu\Block\Entities\Block;

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

/**
 * Block creation
 */
Route::get(Block::createUri(), ['uses' => 'AdminBlockController@create'])
	->middleware('can:create blocks');
Route::post(\BlockCreator::storeUri(), ['uses' => 'AdminBlockController@store'])
	->middleware('can:create blocks');

/**
 * Blocks
 */

Route::get(Block::getUri('index'), ['uses' => 'AdminBlockController@index'])
	->middleware('can:view page blocks');