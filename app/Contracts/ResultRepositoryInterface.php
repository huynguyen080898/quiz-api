<?php

namespace App\Contracts;

interface ResultRepositoryInterface
{
    public function postResult($userID, $examID);
}
