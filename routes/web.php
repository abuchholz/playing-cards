<?php

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('deal-one-card', 'CardController@dealOneCard')->name('dealOneCard');
Route::post('shuffle', 'CardController@shuffle')->name('shuffle');
Route::post('deal-all', 'CardController@dealAll')->name('dealAll');