<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Contracts\ExamRepositoryInterface;

class ExamEloquentRepository extends EloquentRepository implements ExamRepositoryInterface
{
	public function getModel()
	{
		return Exam::class;
	}
}
