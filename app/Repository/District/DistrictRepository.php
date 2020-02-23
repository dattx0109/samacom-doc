<?php


namespace App\Repository\District;


use Illuminate\Support\Facades\DB;

class DistrictRepository
{
    const DATA_TABLE = 'districts';

    public function getList($provinceId)
    {
        return DB::table(self::DATA_TABLE)->where('province_id', $provinceId)->get()->toArray();
    }
}
