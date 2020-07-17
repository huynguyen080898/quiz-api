<?php

namespace App\Repositories;

use App\Models\Quiz;
use App\Contracts\QuizRepositoryInterface;


class QuizEloquentRepository extends EloquentRepository implements QuizRepositoryInterface
{
	public function getModel()
	{
		return Quiz::class;
	}

	public function postQuiz($request)
	{
		return	$this->_model->firstOrCreate([
			'title' => $request->title,
			'image_url' => $request->image_url
		]);
	}

	public function countQuestionGroupQuiz()
	{
		return $this->_model::withCount('questions')->get();
	}
}
