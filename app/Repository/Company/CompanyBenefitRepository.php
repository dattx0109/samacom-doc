<?php


namespace App\Repository\Company;

use Illuminate\Support\Facades\DB;

class CompanyBenefitRepository
{
    const TABLE_NAME = 'company_benefit';

    public function insert($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insert($rawData)
            ;
    }

    public function deleteBenefitAfterUpdate($companyId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('company_id', $companyId)
            ->delete()
            ;
    }
}
