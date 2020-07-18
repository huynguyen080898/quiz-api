<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'user_id',
        'exam_id',
        'score',
        'total_true_answer',
        'total_question',
        'status',
        'exam_key'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam', 'exam_id', 'id');
    }

    public function userAnswers()
    {
        return $this->hasMany('App\Models\UserAnswer', 'result_id', 'id');
    }
}
