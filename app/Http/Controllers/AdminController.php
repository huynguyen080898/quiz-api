<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExportDataService;
use Illuminate\Support\Facades\Auth;
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

    public function login()
    {
        return view('back-end.auth.login');
    }

    public function auth(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin');
        }
        return redirect()->back()->with('messages', 'Tài khoản hoặc mật khẩu không chính xác');
    }
}
