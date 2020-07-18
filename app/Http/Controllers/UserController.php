<?php

namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< HEAD
=======
use Illuminate\Support\Str;
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
use Illuminate\Support\Facades\Mail;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\ResultRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;
    protected $resultRepository;

    public function __construct(ResultRepositoryInterface $resultRepository, UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->resultRepository = $resultRepository;
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
<<<<<<< HEAD
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $email = $request->email;
                $token = \Str::random(20);
                DB::table('password_resets')->insert(
                    ['email' => $email, 'token' => $token]
                );
                $link = url('user/reset-password') . '/' . $token;
                Mail::to($email)->send(new ResetPasswordMail($link, $email));
                return redirect()->back();
            }
        }

        return redirect()->back();
    }
    public function getResetPassword($token)
    {
        if ($token) {
            $exist = DB::table('password_resets')->where('token', '=', $token)->first();
            if ($exist) {
                return view('front-end.pages.reset-password', compact('token'));
            } else
                return redirect()->route('home');
        } else
=======
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
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
            return redirect()->route('home');
    }

    public function postResetPassword($token, Request $request)
    {
<<<<<<< HEAD
        if ($request->password == $request->rePassword) {
            $token = DB::table('password_resets')->where('token', '=', $token)->first();
            $user = User::where('email', $token->email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
=======
        if ($request->password==$request->rePassword) {
            $token=DB::table('password_resets')->where('token', '=', $token)->first();
            $user=User::where('email',$token->email)->first();
            if($user)
            {
                $user->password=bcrypt($request->password);
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
                $user->save();
                return redirect()->route('home');
            }
        }
<<<<<<< HEAD
        return redirect()->route('home');
    }

    public function getUser()
    {
        $id = Auth::user()->id;
        $user = $this->userRepository->find($id);
        return view('front-end.pages.profile', ['user' => $user]);
    }

    public function putUser(Request $request)
    {
        $id = Auth::user()->id;
        $this->userRepository->putUser($request, $id);
        return redirect()->back()->with('messages', 'Lưu thành công');
=======
        else
        return redirect()->route('home');
>>>>>>> 312342a01d678b565250d9485aa4c0d3f20d1c91
    }

    public function getUsers()
    {
        $users = $this->userRepository->getUsers();
        return view('back-end.user.index', ['users' => $users]);
    }

    public function getHistory()
    {
        $id = Auth::user()->id;
        $results = $this->resultRepository->getResultsByUserID($id);

        return view('front-end.pages.history', ['results' => $results]);
    }
}
