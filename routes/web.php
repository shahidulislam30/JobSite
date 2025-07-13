<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@indxe')->name('home');

Route::get('/login','AuthController@loginView')->name('login.view');
Route::post('/login','AuthController@login')->name('login');

Route::get('/registration','AuthController@registerView')->name('register.view');
Route::post('/registration','AuthController@register')->name('register');

Route::get('/job/show/{id}','JobController@show')->name('job.show');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/applicant-profile','ApplicantController@profile')->name('profile');
    Route::get('/logout','AuthController@logout')->name('logout');

    Route::group(['middleware' => 'applicant'], function () {
//        Route::get('/applicant-profile','ApplicantController@profile')->name('profile');
        Route::get('/applicant-profile/edit','ApplicantController@profileEdit')->name('profile.edit');
        Route::put('/applicant-profile/update','ApplicantController@profileupdate')->name('profile.update');
        Route::get('apply-to-job/{id}','ApplyJobController@store')->name('apply.job');
    });

    Route::group(['middleware' => 'employeer'], function () {
        Route::get('/dashboard','EmployeerController@dashboard')->name('dashboard');
        Route::resource('/job','JobController')->except('index','show');
    });
});

