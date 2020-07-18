<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Contracts\ExamRepositoryInterface;
use App\Contracts\QuizRepositoryInterface;

class QuizController extends Controller
{
    protected $quizRepository;
    protected $examRepository;
    public function __construct(QuizRepositoryInterface $quizRepository, ExamRepositoryInterface $examRepository)
    {
        $this->quizRepository = $quizRepository;
        $this->examRepository = $examRepository;
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

    public function getExamByQuizID($quizID)
    {
        $exams = $this->examRepository->getExamByQuizID($quizID);

        return view('front-end.pages.exam', ['exams' => $exams, 'quizID' => $quizID]);
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

    public function countQuestionByQuizID($id)
    {
        $data = Question::where('quiz_id', $id)->select('question_type', 'answer_type', DB::raw('count(*) as question_count_by_type'))
            ->groupBy('question_type', 'answer_type')->get();

        $result = [];
        foreach ($data as $value) {
            $question_type = $value->question_type;
            $answer_type = $value->answer_type;

            $type = '';
            $key = '';
            if ($question_type == 'text') {
                if ($answer_type == 'single_select') {
                    $key = [$question_type . '_' . $answer_type];
                    $type = 'Single select multilple choice questions';
                }
                if ($answer_type == 'multi_select') {
                    $key = $question_type . '_' . $answer_type;
                    $type = 'Multi select multilple choice questions';
                }
                if ($answer_type == 'fill_text') {
                    $key = $question_type . '_' . $answer_type;
                    $type = 'Fill text';
                }
            }

            if ($question_type == 'image') {

                if ($answer_type == 'single_select') {
                    $key = $question_type . '_' . $answer_type;
                    $type = 'Single select image multilple choice questions';
                }

                if ($answer_type == 'multi_select') {
                    $key = $question_type . '_' . $answer_type;
                    $type = 'Multi select image multilple choice questions';
                }
            }

            array_push($result, [
                'type' => $type,
                'key' => $key,
                'total_question' => $value->question_count_by_type
            ]);
        }

        return response()->json($result);
    }
}
