<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Contracts\AnswerRepositoryInterface;

class AnswerEloquentRepository extends EloquentRepository implements AnswerRepositoryInterface
{
	public function getModel()
	{
		return Answer::class;
	}
}
