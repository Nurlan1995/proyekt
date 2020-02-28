<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('/b', function () {
    return view('birthday');
});

Route::get('getBirthdayPeople', 'BirthdayController@getBirthdayPeople');
Route::get('congratulate', 'BirthdayController@congratulate');
Route::get('3333333333', 'BirthdayController@congratulate');
