<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Contracts\UserAnswerRepositoryInterface;

class UserAnswerController extends Controller
{
    protected $userAnswerRepository;

    public function __construct(UserAnswerRepositoryInterface $userAnswerRepository)
    {
        $this->userAnswerRepository = $userAnswerRepository;
    }

    public function putUserAnswer(Request $request)
    {
        return $this->userAnswerRepository->putUserAnswer($request);
    }
}
