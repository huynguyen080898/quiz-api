<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\ExamRepositoryInterface;

class HomeController extends Controller
{
    protected $examRepository;

    public function __construct(ExamRepositoryInterface $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function index()
    {
        $exams = $this->examRepository->getExams();

        return view('front-end.pages.index', ['exams' => $exams]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
