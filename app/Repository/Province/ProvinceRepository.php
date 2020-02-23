<?php


namespace App\Repository\Province;

use Illuminate\Support\Facades\DB;

class ProvinceRepository
{
    const TABLE_NAME = 'provinces';

    public function getList()
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy(DB::raw('FIELD(name,"Hồ Chí Minh","Hà Nội")'), 'DESC')
            ->orderBy('name', 'ASC')->get();
    }
}
