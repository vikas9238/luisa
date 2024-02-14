<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ajax-request'], function () {
    Route::get('{id}/product-detail', 'AjaxRequestController@productDetail')->name('ajax.productDetail');
});
Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('/about', 'PagesController@about')->name('pages.about');
Route::get('/contact', 'PagesController@contact')->name('pages.contact');
Route::post('/contact', 'PagesController@postContact')->name('pages.postContact');
// Route::get('/home', 'HomeController@index')->name('home');
