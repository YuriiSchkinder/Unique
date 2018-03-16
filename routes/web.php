<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>'web'],function (){
   Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
   Route::get('/page/{alias}',['uses'=>'PageController@execude','as'=>'page']);
   Route::auth();
});

Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){
    Route::get('/',function (){

    });
    Route::group(['prefix'=>'pages'],function (){

        Route::get('/',['uses'=>'PagesController@execude','as'=>'pages']);
        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execude','as'=>'pagesAdd']);
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execude','as'=>'pegesEdit']);

    });

    Route::group(['prefix'=>'portfolios'],function (){

        Route::get('/',['uses'=>'PortfolioController@execude','as'=>'portfolio']);
        Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execude','as'=>'portfolioAdd']);
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execude','as'=>'portfolioEdit']);

    });

    Route::group(['prefix'=>'services'],function (){

        Route::get('/',['uses'=>'ServiceController@execude','as'=>'services']);
        Route::match(['get','post'],'/add',['uses'=>'ServiceAddController@execude','as'=>'ServiceAdd']);
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'ServiceEditController@execude','as'=>'ServiceEdit']);

    });
});
