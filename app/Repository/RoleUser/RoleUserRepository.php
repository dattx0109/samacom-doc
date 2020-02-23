<?php


namespace App\Repository\RoleUser;


use App\Repository\User\UserRepository;
use Illuminate\Support\Facades\DB;

class RoleUserRepository
{
    const TABLE_NAME = 'user_role';

    public function deleteRoleId($roleId)
    {
        DB::table(self::TABLE_NAME)
            ->where('role_id',$roleId )
            ->delete()
        ;
    }

    public function getAllRoleByUserId($userId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('user_id', $userId )
            ->pluck('role_id')
        ;
    }

    public function getAllUserOfRoleId($roleId)
    {
        return DB::table(self::TABLE_NAME)
            ->select(UserRepository::USER_TABLE.'.name', UserRepository::USER_TABLE.'.email')
            ->join(UserRepository::USER_TABLE, UserRepository::USER_TABLE.'.id', '=', self::TABLE_NAME.'.user_id')
            ->where(self::TABLE_NAME.'.role_id', $roleId)
            ->get()
        ;
    }
}
