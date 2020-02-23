<?php


namespace App\Repository\Login;

use Illuminate\Support\Facades\DB;

class LoginRepository
{
    const TABLE_USER = 'users';

    public function findUserByEmail($email)
    {
        return DB::table(self::TABLE_USER)
            ->where(function ($query) use ($email) {
                $query->where('email', $email);
                $query->orWhere('phone', $email);
            })
            ->first()
            ;
    }
}
