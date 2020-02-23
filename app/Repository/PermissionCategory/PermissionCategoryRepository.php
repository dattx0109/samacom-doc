<?php


namespace App\Repository\PermissionCategory;


use Illuminate\Support\Facades\DB;

class PermissionCategoryRepository
{
    const TABLE_NAME = 'permission_categories';

    public function insertPermissionCategoryByRawData($rawData)
    {
        return DB::table(self::TABLE_NAME)->insert($rawData);
    }

}