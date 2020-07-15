<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';

    protected $fillable = [
        'result_id',
        'question_id',
        'user_answer',
        'correct'
    ];
}
