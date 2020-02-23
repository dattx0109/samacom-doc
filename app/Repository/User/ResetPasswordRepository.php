<?php

namespace App\Repository\User;

use Illuminate\Support\Facades\DB;

class ResetPasswordRepository
{
    const TABLE_NAME = 'users';
    const DEFAULT_PASSWORD = '123456789a';

    public function reset($id)
    {
        DB::beginTransaction();
        try {
            $arrInsert = [
                'password' => \Hash::make(self::DEFAULT_PASSWORD),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table(self::TABLE_NAME)->insert($arrInsert);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

    }
}
