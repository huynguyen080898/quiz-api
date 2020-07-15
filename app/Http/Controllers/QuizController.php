<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Contracts\QuizRepositoryInterface;

class QuizController extends Controller
{
    protected $quizRepository;

    public function __construct(QuizRepositoryInterface $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function getQuizzes()
    {
        $quizzes = $this->quizRepository->getAll();

        return view('back-end.quiz.index', ['quizzes', $quizzes]);
    }

    public function create()
    {
        return view('back-end.quiz.create');
    }

    public function postQuiz(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'fileImport' => 'required|mimes:png,jpg,jpeg'
        ], [
            'title.required' => 'Tên danh mục không được trống',
            'fileImport.required' => 'Bạn chưa chọn hình ảnh',
            'fileImport.mimes' => 'Ảnh không đúng định dạng '
        ]);

        $image_quiz = Storage::disk('s3')->put('quiz-images', $request->fileImport, 'r');

        $image_url = Storage::disk('s3')->url($image_quiz);

        $request->merge(['image_url' => $image_url]);

        $this->quizRepository->postQuiz($request);

        return redirect()->back()->with('messages', 'Thêm thành công');
    }
}
