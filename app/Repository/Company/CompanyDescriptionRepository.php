<?php


namespace App\Repository\Company;

use Illuminate\Support\Facades\DB;

class CompanyDescriptionRepository
{
    const TABLE_NAME = 'company_description';

    public function insert($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insertGetId([
                'about_us'      => $rawData['about_us'],
                'mission'       => $rawData['mission'],
                'vision'        => $rawData['vision'],
                'core_value'    => $rawData['core_value'],
                'other'         => $rawData['other'],
                'created_at'    => date("Y/m/d H:i:s"),
                'updated_at'    => date("Y/m/d H:i:s"),
            ]);
    }

    public function updateDescription($rawData, $companyDescriptionId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id',$companyDescriptionId)
            ->update($rawData)
        ;
    }


}
