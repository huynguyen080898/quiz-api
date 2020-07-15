<?php

namespace App\Contracts;

interface QuizRepositoryInterface
{
    public function countQuestionGroupQuiz();

    public function postQuiz($request);
}
