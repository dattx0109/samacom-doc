<?php


namespace App\Repository\EmployerPackageCurrent;


use Illuminate\Support\Facades\DB;

class EmployerPackageCurrentRepository
{
    const TABLE_NAME = 'employer_package_current';

    public function detailByEmployerId($employerId)
    {
        return DB::table(self::TABLE_NAME)->where('employer_id', $employerId)->first();
    }
    public function insert($dataInsert)
    {
        return DB::table(self::TABLE_NAME)->insert($dataInsert);
    }
    public function update($dataInsert)
    {
        return DB::table(self::TABLE_NAME)->where('employer_id', $dataInsert['employer_id'])->update($dataInsert);
    }
}
