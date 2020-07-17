<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ResultRepositoryInterface;
use App\Contracts\ExamDetailRepositoryInterface;
use App\Contracts\UserAnswerRepositoryInterface;

class ExamDetailController extends Controller
{
    protected $examDetailRepository;
    protected $resultRepository;
    protected $userAnswerRepository;

    public function __construct(
        ExamDetailRepositoryInterface $examDetailRepository,
        ResultRepositoryInterface $resultRepository,
        UserAnswerRepositoryInterface $userAnswerRepository
    ) {
        $this->examDetailRepository = $examDetailRepository;
        $this->resultRepository = $resultRepository;
        $this->userAnswerRepository = $userAnswerRepository;
    }


    public function getExamDetail($examID)
    {
        $data = $this->examDetailRepository->getExamDetail($examID);
        return view('back-end.exam.detail', ['data' => $data]);
    }

    public function getExamDetailByExamID(Request $request, $examID)
    {
        $userID = 2;

        if (!$request->ajax()) {
            $this->resultRepository->postResult($userID, $examID);
        }

        $data = $this->examDetailRepository->getExamDetailByExamID($examID, $userID);
        // dd($data->toArray());
        $resultID = $data[0]->exam->results[0]->id;
        $questionID = $data[0]->question_id;
        $user_answer = $this->userAnswerRepository->getUserAnswer($resultID, $questionID)->toArray();
        $arr_answers = [];
        // dd($user_answer);
        if (!empty($user_answer)) {
            $i = 0;
            foreach ($user_answer as $value) {
                $arr_answers[$i] = $value['user_answer'];
                $i++;
            }
        }

        if ($request->ajax()) {
            return view('front-end.partial.exam-detail', ['data' => $data, 'user_answer' => $arr_answers]);
        }

        return view('front-end.pages.start-exam', ['data' => $data, 'user_answer' => $arr_answers]);
    }
}
