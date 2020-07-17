<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamDetail extends Model
{
    protected $table = 'exam_details';

    protected $fillable = [
        'exam_id',
        'question_id',
        'score'
    ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam', 'exam_id', 'id');
    }
}
