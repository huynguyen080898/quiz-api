<?php

namespace App\Repositories;

use App\Models\ExamDetail;
use App\Contracts\ExamDetailRepositoryInterface;


class ExamDetailEloquentRepository extends EloquentRepository implements ExamDetailRepositoryInterface
{
	public function getModel()
	{
		return ExamDetail::class;
	}

	public function getExamDetail($examID)
	{
		return $this->_model::with('question:id,title')->where('exam_id', $examID)->get();
	}

	public function getExamDetailByExamID($examID, $userID)
	{
		return $this->_model::with('question.answers', 'exam.results')
			->where('exam_id', $examID)
			->inRandomOrder($userID)
			->paginate(1);
	}
}
