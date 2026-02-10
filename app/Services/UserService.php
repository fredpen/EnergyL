<?php

namespace App\Services;

use App\Models\User;
use App\Queries\UserQueries;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserService
{

    public static function createUser(string $email, string $password, string $name): User
    {
        $user = User::query()
            ->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

        if (!$user) throw new Exception("Unable to generate user");

        return $user;
    }

    /**
     * @throws Exception
     */
    public function login(string $email, string $password): User
    {
        $user = UserQueries::findByEmail($email);
        if (!$user) {
            throw new Exception("Invalid Credentials ");
        }

        if (!Hash::check($password, $user->password)) {
            throw new Exception("Invalid Credentials ");
        }

        return $user;
    }

    /**
     * @throws Exception
     */
    public static function createToken(User $user): string
    {
        $token = $user->createToken('api-token')->plainTextToken;
        if ($token) return $token;

        throw new Exception("Unable to generate user");
    }


}
