<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ExamRepositoryInterface;
use App\Contracts\QuizRepositoryInterface;

class ExamController extends Controller
{
    protected $quizRepository;
    protected $examRepository;

    public function __construct(QuizRepositoryInterface $quizRepository, ExamRepositoryInterface $examRepository)
    {
        $this->quizRepository = $quizRepository;
        $this->examRepository = $examRepository;
    }

    public function getExams()
    {
        $exams = $this->examRepository->getAll();
        return view('back-end.quiz.index', ['exams', $exams]);
    }

    public function create()
    {
        // $total_question = Question::select('quiz_id', DB::raw('count(*) as total_question'))->groupBy('quiz_id')->get();
        $this->quizRepository->countQuestionGroupQuiz();
        // return view('admin.exam.create', ['total_question', $total_question]);
    }
    public function postExam(Request $request)
    { }
}
