<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\UserRepositoryInterface;


class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
	public function getModel()
	{
		return User::class;
	}

	public function getUsers()
	{
		return $this->_model->get();
	}

	public function postUser($request)
	{
		return $this->_model->firstOrCreate([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role' => $request->role ?? 0,
			'avatar_url' => $request->avatar_url ?? null,
			'student_code' => $request->student_code ?? $request->random_student_code
		]);
	}
}
