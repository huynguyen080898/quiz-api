<?php

namespace App\Contracts;

interface UserRepositoryInterface
{
    public function getUsers();

    public function postUser($request);

    public function putUser($request, $userID);
}
