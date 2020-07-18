<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\ExamDetail;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Contracts\ExamDetailRepositoryInterface;
use App\Contracts\UserAnswerRepositoryInterface;

class UserAnswerController extends Controller
{
    protected $userAnswerRepository;
    protected $examDetailRepository;

    public function __construct(
        UserAnswerRepositoryInterface $userAnswerRepository,
        ExamDetailRepositoryInterface $examDetailRepository
    ) {
        $this->userAnswerRepository = $userAnswerRepository;
        $this->examDetailRepository = $examDetailRepository;
    }

    public function putUserAnswer(Request $request)
    {
        return $this->userAnswerRepository->putUserAnswer($request);
    }

    public function getUserAnswerByResultID($examID, $resultID)
    {
        $exam_detail = ExamDetail::where('exam_id', $examID)
            ->join('questions', 'exam_details.question_id', '=', 'questions.id')
            ->select('exam_details.*', 'questions.title as question_title', 'questions.question_type', 'questions.answer_type')
            ->get();

        $arr_question_id = array_keys($exam_detail->groupBy('question_id')->toArray());

        $answers = Answer::whereIn('question_id', $arr_question_id)->get();
        $answers = $answers->groupBy('question_id')->toArray();

        $user_answers = UserAnswer::where('result_id', $resultID)->whereIn('question_id', $arr_question_id)->get();
        $user_answers = $user_answers->groupBy('question_id')->toArray();
        // dd($user_answers);
        $exam_detail = $exam_detail->toArray();

        $data = [];

        foreach ($exam_detail as $value) {
            foreach ($answers as $key => $answer) {
                if ($value['question_id'] == $key) {
                    if ($value['answer_type'] == 'fill_text') {
                        $value['answers'] = array_column($answer, 'title');
                    } else {
                        $value['answers'] = $answer;
                    }
                }
            }
            // if(!empty($user_answers)){
            foreach ($user_answers as $key => $user_answer) {
                // $value['user_answers'] = [];
                if ($value['question_id'] == $key) {
                    $value['user_answers'] = array_column($user_answer, 'user_answer');
                }
            }

            if (empty($value['user_answers'])) {
                $value['user_answers'] = [];
            }

            array_push($data, $value);
        }
        // dd($data);

        return view('front-end.pages.user-answer', ['data' => $data]);
    }
}
