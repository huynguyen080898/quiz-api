<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Quiz;
use App\Contracts\ExamRepositoryInterface;

class ExamEloquentRepository extends EloquentRepository implements ExamRepositoryInterface
{
	public function getModel()
	{
		return Exam::class;
	}

	public function getExams()
	{
		return $this->_model::with('quiz:id,title')->get();
	}

	public function getExam($examID)
	{
		return $this->_model->find($examID);
	}

	public function postExam($request)
	{
		$start_date = ($request->start_date) ?? null;
		$end_date = ($request->end_date) ?? null;
		$start_date_format = $start_date;
		$end_date_format = $end_date;
		$image_url_quiz = Quiz::where('id', $request->quiz_id)->select('image_url')->first();
		$image_url =  $image_url_quiz->image_url;
		if ($start_date != null) {
			$start_date_format = $this->formatDate($start_date);
		}

		if ($end_date != null) {

			$end_date_format = $this->formatDate($end_date);
		}

		return $this->_model->create([
			'quiz_id' => $request->quiz_id,
			'title' => $request->title,
			'time' => $request->time ?? null,
			'description' => $request->description ?? null,
			'start_date' => $start_date_format,
			'start_time' => $request->start_time ?? null,
			'end_date' => $end_date_format,
			'key' => $request->key ?? null,
			'image_url' => $image_url,
		]);
	}

	public function getExamByQuizID($quizID)
	{
		return $this->_model->where('quiz_id', $quizID)->get();
	}

	public function putExam($request, $examID)
	{
		$start_date = ($request->start_date) ?? null;
		$end_date = ($request->end_date) ?? null;
		$start_date_format = $start_date;
		$end_date_format = $end_date;

		if ($start_date != null) {
			$start_date_format = $this->formatDate($start_date);
		}

		if ($end_date != null) {

			$end_date_format = $this->formatDate($end_date);
		}

		return $this->_model->where('id', $examID)->update([
			'title' => $request->title ?? null,
			'time' => $request->time ?? null,
			'description' => $request->description ?? null,
			'start_date' => $start_date_format,
			'start_time' => $request->start_time ?? null,
			'end_date' => $end_date_format,
			'key' => $request->key ?? null
		]);
	}

	public function formatDate($date)
	{
		$oldDate = Carbon::createFromFormat('d/m/Y', $date)->toDateString();
		$newDate = date('Y-m-d', strtotime($oldDate));
		return $newDate;
	}
}
