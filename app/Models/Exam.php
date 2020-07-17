<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'title',
        'quiz_id',
        'time',
        'score',
        'description',
        'status',
        'key',
        'image_url',
        'start_date',
        'start_time',
        'end_date',
        'exam_key'
    ];

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'quiz_id', 'id');
    }

    public function examDetails()
    {
        return $this->hasMany('App\Models\ExamDetail', 'exam_id', 'id');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result', 'exam_id', 'id');
    }
}
