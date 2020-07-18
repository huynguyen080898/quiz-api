<?php

namespace App\Contracts;

interface ResultRepositoryInterface
{
    public function getResultsByUserID($userID);

    public function postResult($userID, $examID);

    public function putResult($request, $resultID);

    public function getStatistics($exam_id);
}
