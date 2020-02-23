<?php

namespace App\Repository\User;

use Illuminate\Support\Facades\DB;

class ShowDetailRepository
{
    const TABLE_NAME = 'users';
    const USER_ROLE_TABLE_NAME = 'user_role';
    const ROLE_TABLE_NAME = 'roles';

    public function detail($id)
    {
        $user = DB::table(self::TABLE_NAME)
            ->leftJoin(self::USER_ROLE_TABLE_NAME, self::USER_ROLE_TABLE_NAME.'.user_id', '=', self::TABLE_NAME.'.id')
            ->leftJoin(self::ROLE_TABLE_NAME, self::ROLE_TABLE_NAME.'.id', '=', self::USER_ROLE_TABLE_NAME.'.role_id')
            ->where(self::TABLE_NAME.'.id', $id)
            ->select(self::TABLE_NAME.'.id',self::TABLE_NAME.'.name', self::TABLE_NAME.'.email', self::TABLE_NAME.'.phone',self::TABLE_NAME.'.deleted_by',
                self::TABLE_NAME.'.phone', self::ROLE_TABLE_NAME.'.id as role_id')
            ->get()
        ;
//        dd($user);
        return $user;
    }
}
