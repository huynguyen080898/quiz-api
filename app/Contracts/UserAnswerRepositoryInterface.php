<?php

namespace App\Contracts;

interface UserAnswerRepositoryInterface
{
    public function getUserAnswer($resultID, $questionID);

    public function getUserAnswerByResultID($resultID);

    public function putUserAnswer($request);
}
