<?php

namespace App\Contracts;

interface AnswerRepositoryInterface
{
    public function getAnswerByQuestionID($questionID);
}
