<?php

namespace App\Providers;

use App\Models\Quiz;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Contracts\UserRepositoryInterface::class,
            \App\Repositories\UserEloquentRepository::class
        );

        $this->app->singleton(
            \App\Contracts\UserAnswerRepositoryInterface::class,
            \App\Repositories\UserAnswerEloquentRepository::class
        );

        $this->app->singleton(
            \App\Contracts\QuizRepositoryInterface::class,
            \App\Repositories\QuizEloquentRepository::class
        );

        $this->app->singleton(
            \App\Contracts\QuestionRepositoryInterface::class,
            \App\Repositories\QuestionEloquentRepository::class
        );

        $this->app->singleton(
            \App\Contracts\AnswerRepositoryInterface::class,
            \App\Repositories\AnswerEloquentRepository::class
        );

        $this->app->singleton(
            \App\Contracts\ExamRepositoryInterface::class,
            \App\Repositories\ExamEloquentRepository::class
        );

        $this->app->singleton(
            \App\Contracts\ExamDetailRepositoryInterface::class,
            \App\Repositories\ExamDetailEloquentRepository::class
        );

        $this->app->singleton(
            \App\Contracts\ResultRepositoryInterface::class,
            \App\Repositories\ResultEloquentRepository::class
        );
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data['quizzes'] = Quiz::all();
        view()->share($data);
    }
}
