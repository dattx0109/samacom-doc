<?php


namespace App\Repository\Permission;


use App\Repository\PermissionCategory\PermissionCategoryRepository;
use App\Repository\PermissionRole\PermissionRoleRepository;
use Illuminate\Support\Facades\DB;

class PermissionRepository
{
    const TABLE_NAME = 'permissions';

    public function insertPermissionByRawData($rawData)
    {
        return DB::table(self::TABLE_NAME)->insert($rawData);
    }

    public function getAllPermission()
    {
        return DB::table(self::TABLE_NAME)
            ->select(self::TABLE_NAME.'.*', PermissionCategoryRepository::TABLE_NAME.'.name as category_name')
            ->join(
                PermissionCategoryRepository::TABLE_NAME,
                self::TABLE_NAME.'.permission_category_id',
                '=',
                PermissionCategoryRepository::TABLE_NAME.'.id'
            )
            ->get()
        ;
    }

    public function checkPermissionByCodeAndRole($listRole, $permisisonCode)
    {
        return DB::table(self::TABLE_NAME)
            ->join(
                PermissionRoleRepository::TABLE_NAME,
                self::TABLE_NAME.'.id',
                    '=',
                PermissionRoleRepository::TABLE_NAME.'.permission_id'
                )
            ->where(self::TABLE_NAME.'.code', $permisisonCode)
            ->whereIn(PermissionRoleRepository::TABLE_NAME.'.role_id', $listRole)
            ->count()
        ;
    }
}