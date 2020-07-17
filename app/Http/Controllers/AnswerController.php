<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AnswerRepositoryInterface;

class AnswerController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepositoryInterface $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function getAnswerByQuestionID($questionID)
    {
        $answers = $this->answerRepository->getAnswerByQuestionID($questionID);
        return view('back-end.answer.index', ['answers' => $answers]);
    }
}
