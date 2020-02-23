<?php


namespace App\Repository\Referral;


use App\Repository\Job\JobRepository;
use Illuminate\Support\Facades\DB;

class ReferralCreatePasswordRepository
{
    const TABLE_NAME = 'referral_user_create_password';

    public function createTokenAfterRegisterReferralUser($data)
    {
        return DB::table(self::TABLE_NAME)->insert($data);
    }

    public function checkTokenActive($token)
    {
        return DB::table(self::TABLE_NAME)->where([
            ['token', $token], ['status', 1] // 1-new user 2- change pass
        ])->first();
    }

    public function updateStatus($condition, $data)
    {
        return DB::table(self::TABLE_NAME)->where($condition)->insert($data);
    }
}
