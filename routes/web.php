<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);


Route::get('/docs', 'DocController@index');

Route::get('/item/{id}', 'ItemController@show')->name('item-show');
Route::get('/item/{id}/show/more', 'ItemController@showMore');

Route::get('/guides', 'GuideController@index');
Route::get('/guide/{slug}', 'GuideController@show');
Route::put('/guide/{slug}/views', 'GuideController@increment');

Route::get('monster/list', 'MonsterController@list');
Route::get('monsters', 'MonsterController@index');
Route::get('monster/{slug}', 'MonsterController@show');

Route::get('dungeon/list', 'DungeonController@list');
Route::get('dungeons', 'DungeonController@index');
Route::get('dungeon/{slug}', 'DungeonController@show');





Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::get('categories', 'Admin\CategoryController@index');
    Route::get('category/create', 'Admin\CategoryController@create');
    Route::post('category/create', 'Admin\CategoryController@store');
    Route::get('category/{id}/edit', 'Admin\CategoryController@edit');
    Route::put('category/{id}/edit', 'Admin\CategoryController@update');
    Route::get('category/search/{key}', 'Admin\CategoryController@search');


    Route::get('sub/category', 'Admin\SubCategoryController@index');
    Route::get('sub/category/create', 'Admin\SubCategoryController@create');
    Route::post('sub/category/create', 'Admin\SubCategoryController@store');
    Route::get('sub/category/{id}/edit', 'Admin\SubCategoryController@edit');
    Route::put('sub/category/{id}/edit', 'Admin\SubCategoryController@update');
    Route::get('sub/category/search/{key}', 'Admin\SubCategoryController@search');

    Route::get('records/item', 'Admin\ItemController@items');
    Route::get('items', 'Admin\ItemController@index');
    Route::get('item/create', 'Admin\ItemController@create');
    Route::post('item/create', 'Admin\ItemController@store');
    Route::get('item/{id}/edit', 'Admin\ItemController@edit');
    Route::post('item/{id}/edit', 'Admin\ItemController@update');
    Route::get('item/search/{key}', 'Admin\ItemController@search');

    Route::get('records/set', 'Admin\SetController@sets');
    Route::get('records/set/item', 'Admin\SetController@items');
    Route::get('set', 'Admin\SetController@index');
    Route::get('set/create', 'Admin\SetController@create');
    Route::post('set/create', 'Admin\SetController@store');
    Route::get('set/{id}/edit', 'Admin\SetController@edit');
    Route::put('set/{id}/edit', 'Admin\SetController@update');
    Route::get('set/item/search/{key}', 'Admin\SetController@searchItem');
    Route::get('set/search/{key}', 'Admin\SetController@searchSet');

    Route::get('records/article', 'Admin\ArticleController@articles');
    Route::get('articles', 'Admin\ArticleController@index');
    Route::get('article/create', 'Admin\ArticleController@create');
    Route::post('article/create', 'Admin\ArticleController@store');
    Route::get('article/{id}/edit', 'Admin\ArticleController@edit');
    Route::put('article/{id}/edit', 'Admin\ArticleController@update');
    Route::get('article/search/{key}', 'Admin\ArticleController@search');

    Route::get('widget/item/count', 'Admin\ItemController@count');
    Route::get('widget/category/count', 'Admin\CategoryController@count');
    Route::get('widget/sub/category/count', 'Admin\SubCategoryController@count');
    Route::get('widget/article/count', 'Admin\ArticleController@count');

    Route::get('records/monster', 'Admin\MonsterController@monster');
    Route::get('monsters', 'Admin\MonsterController@index');
    Route::get('monster/create', 'Admin\MonsterController@create');
    Route::post('monster/create', 'Admin\MonsterController@store');
    Route::get('monster/{id}/edit', 'Admin\MonsterController@edit');
    Route::put('monster/{id}/edit', 'Admin\MonsterController@update');
    Route::get('monster/search/{key}', 'Admin\MonsterController@search');

    Route::get('records/dungeon', 'Admin\DungeonController@dungeon');
    Route::get('dungeons', 'Admin\DungeonController@index');
    Route::get('dungeon/create', 'Admin\DungeonController@create');
    Route::post('dungeon/create', 'Admin\DungeonController@store');
    Route::get('dungeon/{id}/edit', 'Admin\DungeonController@edit');
    Route::put('dungeon/{id}/edit', 'Admin\DungeonController@update');
    Route::get('dungeon/search/{key}', 'Admin\DungeonController@search');
});
