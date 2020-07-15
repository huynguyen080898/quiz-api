<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'title', 'image_url'
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'quiz_id', 'id');
    }

    public function exams()
    {
        return $this->hasMany('App\Models\Exam', 'quiz_id', 'id');
    }
}
