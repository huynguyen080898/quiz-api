<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function postUser(Request $request)
    {
        if ($request->has('formSignIn')) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->back();
            }
        }

        if ($request->has('formSignUp')) {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8'
            ]);

            $this->userRepository->postUser($request);
            return redirect()->back();
        }
    }

    public function getUsers()
    {
        $users = $this->userRepository->getUsers();
        return view('back-end.user.index', ['users' => $users]);
    }
}
