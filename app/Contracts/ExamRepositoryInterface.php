<?php

namespace App\Contracts;

interface ExamRepositoryInterface
{
    public function getExams();

    public function getExam($examID);

    public function postExam($request);

    public function putExam($request, $exam);
}
