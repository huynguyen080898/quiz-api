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
    Route::get('/', 'UserController@getUsers')->name('user.getAll');
    Route::get('reset-password/{token}','UserController@getResetPassword')->name('user.getResetPassword');
    Route::post('reset-password/{token}','UserController@postResetPassword')->name('user.postResetPassword');
});

Route::group(['prefix' => 'user-answer'], function () {
    Route::put('/', 'UserAnswerController@putUserAnswer')->name('user.answer');
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
    Route::post('store', 'ExamController@postExam')->name('exam.store');
    Route::get('edit/{id}', 'ExamController@getExam')->name('exam.edit');
    Route::post('update/{id}', 'ExamController@putExam')->name('exam.update');

    Route::group(['prefix' => 'detail'], function () {
        Route::get('{id}/start', 'ExamDetailController@getExamDetailByExamID')->name('exam.detail.get');
        Route::get('{id}', 'ExamDetailController@getExamDetail')->name('exam.detail');
    });
});

Route::group(['prefix' => 'question'], function () {
    Route::get('/', 'QuestionController@getQuestions')->name('question.getAll');
    Route::get('create', 'QuestionController@create')->name('question.create');
    Route::post('store', 'QuestionController@postQuestions')->name('question.store');

    Route::get('{id}/answers', 'AnswerController@getAnswerByQuestionID')->name('question.getAnswers');
});

Route::get('/', 'HomeController@index')->name('home');
