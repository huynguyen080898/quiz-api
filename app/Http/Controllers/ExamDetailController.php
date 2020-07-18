<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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
        $user =  Auth::user();
        $userID = $user->id;
        if (!$request->ajax()) {
            if (empty($user->student_code)) {
                return redirect()->route('user.profile');
            }
            $this->resultRepository->postResult($userID, $examID);
        }

        $data = $this->examDetailRepository->getExamDetailByExamID($examID, $userID);

        $exam = $data[0]->exam;
        $result = $data[0]->exam->results[0];

        if (!$request->ajax() && !empty($exam->start_date)) {
            $today = Carbon::now();
            $date  = $today->toDateString();
            $time = $today->toTimeString();
            Log::debug($time);
            Log::debug($exam->start_time);
            if ($exam->start_date < $date || ($exam->start_date == $date && $exam->start_time > $time)) {
                return redirect()->back()->with('alert', 'Bài thi chưa mở');
            }
        }

        if (!empty($exam->key) && empty($result->exam_key)) {
            return view('front-end.pages.exam-key', ['result_id' => $result->id]);
        }

        if ($result->status == 'close') {
            return redirect()->back()->with('alert', 'Bạn đã hoàn thành bài thi');
        }

        $questionID = $data[0]->question_id;

        $user_answer = $this->userAnswerRepository->getUserAnswer($result->id, $questionID)->toArray();
        $arr_answers = [];

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

        $result->total_question = $data->total();
        $result->save();

        $exam_time = Carbon::parse($result->created_at)->addMinutes($exam->time);

        return view('front-end.pages.start-exam', ['data' => $data, 'user_answer' => $arr_answers, 'exam_time' => $exam_time]);
    }
}
