<?php


namespace App\Repository\Company;


use Illuminate\Support\Facades\DB;

class CompanyDescriptionRepositoryTest
{
    const TABLE_NAME = 'company_description';

    public function insertDescription($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insertGetId($rawData)
            ;
    }
}
