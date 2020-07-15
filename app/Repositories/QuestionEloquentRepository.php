<?php

namespace App\Repositories;

use App\Models\Question;
use App\Contracts\QuestionRepositoryInterface;

class QuestionEloquentRepository extends EloquentRepository implements QuestionRepositoryInterface
{
	public function getModel()
	{
		return Question::class;
	}
}
