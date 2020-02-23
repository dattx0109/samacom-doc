<?php


namespace App\Repository\PermissionRole;


use Illuminate\Support\Facades\DB;

class PermissionRoleRepository
{
    const TABLE_NAME = 'permission_role';

    public function getAllPermissionByRoleId($roleId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('role_id', $roleId)
            ->pluck('role_id', 'permission_id');
    }

    public function deleteUserRoleByRoleId($roleId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('role_id', $roleId)
            ->delete()
            ;
    }

    public function insertUserRoleByRawData($rawData)
    {
        return DB::table(self::TABLE_NAME)->insert($rawData);
    }
}