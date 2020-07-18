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

	public function getResultsByUserID($userID)
	{
		return $this->_model::with('exam:id,title')->where('user_id', $userID)->get();
	}

	public function putResult($request, $resultID)
	{
		$result = $this->_model->find($resultID);
		$result->fill($request->all());
		$result->save();
		return $result;
	}
}
