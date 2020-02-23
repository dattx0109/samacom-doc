<?php
/**
 * Created by PhpStorm.
 * User: thanhvuminh
 * Date: 9/25/19
 * Time: 10:05 AM
 */

namespace App\Repository\Employer;

use Illuminate\Support\Facades\DB;
class RegisterEmployeerRepository
{
    const TABLE_NAME = 'employers';

    public function register($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insertGetId($rawData)
            ;
    }

    public function getUserByPhone($phone)
    {
        return DB::table(self::TABLE_NAME)
            ->where('phone', $phone)
            ->first();
    }

    public function findEmailByPhone($phone)
    {
        return DB::table(self::TABLE_NAME)
            ->where('phone', $phone)
            ->count()
            ;
    }

    public function findEmailAfterRegister($email)
    {
        return DB::table(self::TABLE_NAME)
            ->where('email',$email)
            ->count()
            ;
    }

    public function findPhoneAfterRegister($phone)
    {
        return DB::table(self::TABLE_NAME)
            ->where('phone',$phone)
            ->count()
            ;
    }

    public function changePassword($passwordNew,$id)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id',$id)
            ->update([
                'password' => Hash::make($passwordNew)
            ]);
    }

}
