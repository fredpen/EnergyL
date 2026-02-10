<?php

namespace App\Queries;

use App\Models\User;

class UserQueries
{
    public static function findByEmail(string $email): User|null
    {
        return User::query()
            ->where('email', $email)
            ->select(['id', 'password', 'name', 'email'])
            ->first();
    }

}
