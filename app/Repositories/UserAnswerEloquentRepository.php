<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;
use App\Contracts\UserAnswerRepositoryInterface;

class UserAnswerEloquentRepository extends EloquentRepository implements UserAnswerRepositoryInterface
{
	public function getModel()
	{
		return UserAnswer::class;
	}


	public function getUserAnswer($resultID, $questionID)
	{
		return $this->_model->where([['result_id', $resultID], ['question_id', $questionID]])
			->select('user_answer')->get();
	}

	public function getUserAnswerByResultID($resultID)
	{
		return $this->_model->where('result_id', $resultID)->get();
	}

	public function putUserAnswer($request)
	{
		$user_answer = $request->user_answer;
		$question_id = $request->question_id;
		$result_id = $request->result_id;
		$type = $request->type;

		if ($type === 'radio') {
			$checkAnswer = Answer::where([['question_id', $question_id], ['id', $user_answer]])->select('correct')->first();

			$correct = $checkAnswer->correct;

			return $this->_model->updateOrCreate(['question_id' => $question_id, 'result_id' => $result_id], ['user_answer' => $user_answer, 'correct' => $correct]);
		}

		if ($type === 'checkbox') {

			$arr_answer_delete = [];

			foreach ($user_answer as $answer) {
				Log::debug($answer);
				if ($answer['checked'] === 'false') {
					array_push($arr_answer_delete, [
						$answer['id']
					]);
					continue;
				}

				$checkAnswer = Answer::where([['question_id', $question_id], ['id', $answer['id']]])->select('correct')->first();
				$correct = $checkAnswer->correct;

				$arr_check = [
					'question_id' => $question_id,
					'result_id' => $result_id,
					'user_answer' => $answer['id']
				];

				$this->_model->firstOrCreate($arr_check, ['correct' => $correct]);
			}
			return	$this->deleteUserAnswer($question_id, $result_id, $arr_answer_delete, $arr_answer_delete);
		}

		if ($type === 'fill_text') {
			$answers = Answer::where('question_id', $question_id)->pluck('title')->toArray();

			$correct = in_array($user_answer, $answers) ? true : false;

			return $this->_model->updateOrCreate(['question_id' => $question_id, 'result_id' => $result_id], ['user_answer' => $user_answer, 'correct' => $correct]);
		}
	}

	public function deleteUserAnswer($question_id, $result_id, $arr_answer_delete)
	{
		return $this->_model->where([['question_id', $question_id], ['result_id', $result_id]])
			->whereIn('user_answer', $arr_answer_delete)
			->delete();
	}
}
