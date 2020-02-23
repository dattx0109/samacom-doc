<?php


namespace App\Repository\Company;


use Illuminate\Support\Facades\DB;

class CompanyRepositoryTest
{
    const TABLE_NAME = 'companies';

    public function insertCompany($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insertGetId($rawData)
            ;
    }
}
