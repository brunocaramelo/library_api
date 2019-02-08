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

Route::group(['prefix' => 'v1'], function ()
{
    Route::get('/authors',
        [ 'as' => 'authors-list',
        'uses' => '\App\Domain\Authors\Controllers\AuthorsController@getAll'
    ]);
    
    Route::group(['prefix' => 'author'], function ()
    {
        Route::get('/{id}',
            [ 'as' => 'author-detail',
            'uses' => '\App\Domain\Authors\Controllers\AuthorsController@getById'
        ]);

        Route::put('/{id}',
            [ 'as' => 'author-store',
            'uses' => '\App\Domain\Authors\Controllers\AuthorsController@store'
        ]);

        Route::post('/',
            [ 'as' => 'author-create',
            'uses' => '\App\Domain\Authors\Controllers\AuthorsController@create'
        ]);
    });

});