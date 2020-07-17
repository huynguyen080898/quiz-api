<?php

namespace App\Contracts;

interface ExamDetailRepositoryInterface
{
    public function getExamDetail($examID);
    public function getExamDetailByExamID($examID, $userID);
}
