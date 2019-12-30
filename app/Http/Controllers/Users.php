<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Collection;

class Users extends Controller
{
    /**
     * Fetch all users
     * @return User[]|Collection
     */
    public function index()
    {
        return new \App\Http\Resources\Users(User::all());
    }

    public function show(User $user)
    {
        return new \App\Http\Resources\User($user);
    }
}
