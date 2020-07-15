<?php

namespace App\Repositories;

use App\Models\Result;
use App\Repositories\EloquentRepository;


class ResultEloquentRepository extends EloquentRepository implements ResultRepositoryInterface
{
	public function getModel()
	{
		return Result::class;
	}
}
