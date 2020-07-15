<?php

namespace App\Repositories;

use App\Models\ExamDetail;
use App\Repositories\EloquentRepository;


class ExamDetailEloquentRepository extends EloquentRepository implements ExamDetailRepositoryInterface
{
	public function getModel()
	{
		return ExamDetail::class;
	}
}
