<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('front-end.pages.index');
});


Route::group(['prefix' => 'user'], function () {
    Route::post('create', 'UserController@postUser')->name('user.post');
});


Route::group(['prefix' => 'quiz'], function () {
    Route::get('/', 'QuizController@getQuizzes')->name('quiz.getAll');
    Route::get('create', 'QuizController@create')->name('quiz.create');
    Route::post('store', 'QuizController@postQuiz')->name('quiz.stote');
    // Route::put('update')
});


Route::group(['prefix' => 'exam'], function () {
    Route::get('/', 'ExamController@getExams')->name('exam.getAll');
    Route::get('create', 'ExamController@create')->name('exam.create');
    Route::post('store', 'ExamController@postExam')->name('exam.stote');
});
