<?php


namespace App\Repository\Package;


use Illuminate\Support\Facades\DB;

class PackageAdminAdd
{
    const TABLE_NAME = 'package_admin_add';
    public function insert($dataInsert)
    {
      return  DB::table(self::TABLE_NAME)->insertGetId($dataInsert);
    }
}
