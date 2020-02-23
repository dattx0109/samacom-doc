<?php


namespace App\Repository\Role;


use Illuminate\Support\Facades\DB;

class RoleRepository
{
    const TABLE_NAME = 'roles';
    const ITEM_PER_PAGE = 10;

    public function getAllRole()
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy('id', 'DESC')
            ->paginate(self::ITEM_PER_PAGE)
        ;
    }

    public function getAllRoleNotPage()
    {
        return DB::table(self::TABLE_NAME)
            ->get()
        ;
    }

    public function getRoleById($roleId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $roleId )
            ->first()
        ;
    }

    public function deleteRoleByRoleId($roleId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $roleId )
            ->delete()
        ;
    }


    public function findRoleByName($roleName)
    {
        return DB::table(self::TABLE_NAME)
            ->where('name', $roleName)
            ->count()
        ;
    }

    public function insertRole($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insert($rawData)
        ;
    }

    public function getListRole(){
        return DB::table(self::TABLE_NAME)
            ->get();
    }

    public function updateRoleByRoleId($rawData, $roleId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $roleId)
            ->update($rawData)
        ;
    }
}
