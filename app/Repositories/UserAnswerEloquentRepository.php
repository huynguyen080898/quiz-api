<?php

namespace App\Repositories;

use App\Models\UserAnswer;
use App\Repositories\EloquentRepository;

class UserAnswerEloquentRepository extends EloquentRepository implements UswerAnswerRepositoryInterface
{
	public function getModel()
	{
		return UserAnswer::class;
	}
}
