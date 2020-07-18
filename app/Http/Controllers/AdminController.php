<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExportDataService;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\ExamRepositoryInterface;
use App\Contracts\QuizRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\QuestionRepositoryInterface;

class AdminController extends Controller
{
    protected $userRepository;
    protected $quizRepository;
    protected $questionRepository;
    protected $examRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ExamRepositoryInterface $examRepository,
        QuestionRepositoryInterface $questionRepository,
        QuizRepositoryInterface $quizRepository
    ) {
        $this->userRepository = $userRepository;
        $this->examRepository = $examRepository;
        $this->questionRepository = $questionRepository;
        $this->quizRepository = $quizRepository;
    }

    public function index()
    {
        $data = [];
        $data['user_count'] = $this->userRepository->count();
        $data['exam_count'] = $this->examRepository->count();
        $data['question_count'] = $this->questionRepository->count();
        $data['quiz_count'] = $this->quizRepository->count();
        // dd($data);
        return view('back-end.index', compact('data'));
    }

    public function export($id)
    {
        return Excel::download(new ExportDataService($id), 'thongke.xlsx');
        // return redirect()->back()->with('messages', 'Lưu thành công');
    }
}
