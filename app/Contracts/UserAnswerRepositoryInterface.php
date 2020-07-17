<?php

namespace App\Contracts;

interface UserAnswerRepositoryInterface
{
    public function getUserAnswer($resultID, $questionID);

    public function putUserAnswer($request);
}
