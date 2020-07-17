<?php

namespace App\Repositories;

use App\Models\Result;
use App\Repositories\EloquentRepository;
use App\Contracts\ResultRepositoryInterface;


class ResultEloquentRepository extends EloquentRepository implements ResultRepositoryInterface
{
	public function getModel()
	{
		return Result::class;
	}

	public function postResult($userID, $examID)
	{
		return $this->_model->firstOrCreate([
			'user_id' => $userID,
			'exam_id' => $examID
		]);
	}
}
