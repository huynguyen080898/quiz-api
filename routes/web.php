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


Route::group(['prefix' => 'user'], function () {
    Route::post('create', 'UserController@postUser')->name('user.post');
    Route::get('/', 'UserController@getUsers')->name('user.getAll')->middleware('admin');
    Route::get('profile', 'UserController@getUser')->name('user.profile')->middleware('user');
    Route::post('profile', 'UserController@putUser')->name('user.update')->middleware('user');
    Route::get('reset-password/{token}', 'UserController@getResetPassword')->name('user.getResetPassword');
    Route::post('reset-password/{token}', 'UserController@postResetPassword')->name('user.postResetPassword');
    Route::get('history', 'UserController@getHistory')->name('user.history')->middleware('user');
});

Route::group(['prefix' => 'user-answer'], function () {
    Route::put('/', 'UserAnswerController@putUserAnswer')->name('user.answer')->middleware('user');
    Route::get('{exam_id}/{result_id}', 'UserAnswerController@getUserAnswerByResultID')->name('user.getResultDetail');
});

Route::group(['prefix' => 'quiz'], function () {
    Route::get('/', 'QuizController@getQuizzes')->name('quiz.getAll')->middleware('admin');
    Route::get('create', 'QuizController@create')->name('quiz.create')->middleware('admin');
    Route::post('store', 'QuizController@postQuiz')->name('quiz.stote')->middleware('admin');
    Route::get('{id}/count/question', 'QuizController@countQuestionByQuizID')->name('quiz.count.question');
    Route::get('{id}/exam', 'QuizController@getExamByQuizID')->name('quiz.exam');
    // Route::put('update')
});


Route::group(['prefix' => 'exam'], function () {
    Route::get('/', 'ExamController@getExams')->name('exam.getAll')->middleware('admin');
    Route::get('create', 'ExamController@create')->name('exam.create')->middleware('admin');
    Route::post('store', 'ExamController@postExam')->name('exam.store')->middleware('admin');
    Route::get('edit/{id}', 'ExamController@getExam')->name('exam.edit')->middleware('admin');
    Route::post('update/{id}', 'ExamController@putExam')->name('exam.update')->middleware('admin');
    Route::get('{id}/statistical', 'ExamController@getStatistics')->name('exam.statistical')->middleware('admin');

    Route::group(['prefix' => 'detail'], function () {
        Route::get('{id}/start', 'ExamDetailController@getExamDetailByExamID')->name('exam.detail.get')->middleware('user');
        Route::get('{id}', 'ExamDetailController@getExamDetail')->name('exam.detail')->middleware('admin');
    });
});

Route::group(['prefix' => 'question', 'middleware' => 'admin'], function () {
    Route::get('/', 'QuestionController@getQuestions')->name('question.getAll');
    Route::get('create', 'QuestionController@create')->name('question.create');
    Route::post('store', 'QuestionController@postQuestions')->name('question.store');

    Route::get('{id}/answers', 'AnswerController@getAnswerByQuestionID')->name('question.getAnswers');
});


Route::group(['prefix' => 'result'], function () {
    Route::get('/{id}', 'ResultController@getResult')->name('exam.result')->middleware('user');
    Route::post('{id}/key', 'ResultController@putResult')->name('result.key')->middleware('user');
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('admin', 'AdminController@index')->name('admin')->middleware('admin');

Route::get('admin/login', 'AdminController@login')->name('admin.login');

Route::post('admin/login', 'AdminController@auth')->name('admin.auth');

Route::get('logout', 'HomeController@logout')->name('logout');

Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('login.social');

Route::get('/callback/{social}', 'SocialAuthController@callback');

Route::get('export/{id}', 'AdminController@export')->name('export')->middleware('admin');
