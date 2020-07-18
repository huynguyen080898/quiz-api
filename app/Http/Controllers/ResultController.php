<?php

namespace App\Http\Controllers;

use App\Contracts\ExamRepositoryInterface;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Contracts\ResultRepositoryInterface;
use App\Contracts\UserAnswerRepositoryInterface;

class ResultController extends Controller
{
    protected $resultRepository;
    protected $userAnswerRepository;
    protected $examRepository;

    public function __construct(
        ResultRepositoryInterface $resultRepository,
        UserAnswerRepositoryInterface $userAnswerRepository,
        ExamRepositoryInterface $examRepository
    ) {
        $this->resultRepository = $resultRepository;
        $this->userAnswerRepository = $userAnswerRepository;
        $this->examRepository = $examRepository;
    }

    public function getResult($id)
    {
        $result_details = $this->userAnswerRepository->getUserAnswerByResultID($id);

        $result_details = $result_details->groupBy('question_id')->toArray();
        // dd($result_details);
        $total_true_answer = 0;

        foreach ($result_details as $key => $values) {
            foreach ($values as $value) {
                $user_answer = $value['user_answer'];

                if (is_numeric($user_answer)) {
                    $checkAnswer = Answer::where([['question_id', $key], ['id', $user_answer]])->select('correct')->first();

                    if (!$checkAnswer->correct) {
                        continue;
                    }

                    $total_true_answer += 1;
                    continue;
                }

                $answers = Answer::where('question_id', $key)->pluck('title')->toArray();

                if (in_array($user_answer, $answers)) {
                    $total_true_answer += 1;
                }
            }
        }

        $result = $this->resultRepository->find($id);
        $exam = $this->examRepository->find($result->exam_id);

        $score = 0;

        if ($result->total_question > 0) {
            $score = ($exam->score / $result->total_question) * $total_true_answer;
            $score = round($score, 0, PHP_ROUND_HALF_UP);
        }

        $result->total_true_answer = $total_true_answer;
        $result->score = $score;
        $result->status = 'close';
        $result->save();

        // dd($result->toArray());
        return view('front-end.pages.result', ['result' => $result]);
    }


    public function putResult(Request $request, $resultID)
    {
        $result = $this->resultRepository->putResult($request, $resultID);

        return redirect()->route('exam.detail.get', $result->exam_id);
    }
}
