<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            // dd('ok');
            // $validatedData = $request->validate([
            //     'name' => 'required',
            //     'email' => 'required|email',
            //     'password' => 'required|confirmed|min:8'
            // ]);

           $this->userRepository->postUser($request);
            return redirect()->back();
        }
// gui mail
        if ($request->has('formSendMail')) {
            // $validatedData = $request->validate([
            //     'email' => 'required|email',
            // ]);
            $user=User::where('email',$request->email)->first();
            if($user)
            {
                $email=$request->email;
                $token=Str::random(20);
                DB::table('password_resets')->insert(
                    ['email' => $email, 'token' => $token]
                );
                $link=url('user/reset-password').'/'.$token;
                Mail::to($email)->send(new ResetPasswordMail($link,$email));
                return redirect()->back();
            }
        }
    }

    public function getResetPassword($token)
    {
        if($token)
        {
            $exist = DB::table('password_resets')->where('token', '=', $token)->first();
            if($exist)
            {
                return view('front-end.pages.reset-password',compact('token'));
            }
            else
                return redirect()->route('home');
        }
        else
            return redirect()->route('home');
    }

    public function postResetPassword($token, Request $request)
    {
        if ($request->password==$request->rePassword) {
            $token=DB::table('password_resets')->where('token', '=', $token)->first();
            $user=User::where('email',$token->email)->first();
            if($user)
            {
                $user->password=bcrypt($request->password);
                $user->save();
                return redirect()->route('home');
            }
        }
        else
        return redirect()->route('home');
    }

    public function getUsers()
    {
        $users = $this->userRepository->getUsers();
        return view('back-end.user.index', ['users' => $users]);
    }
}
