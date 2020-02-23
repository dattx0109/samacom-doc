<?php


namespace App\Repository\cv4d;
use Illuminate\Support\Facades\DB;

class Cv4dRepository
{
    const TABLE_NAME = 'cv_4d';
    public function insertCv4($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insert($rawData)
            ;
    }

    public function countDataType1()
    {
        return DB::table(self::TABLE_NAME)
            ->where('type', 1)
            ->count();
    }

    public function countDataType2()
    {
        return DB::table(self::TABLE_NAME)
            ->where('type', 2)
            ->count();
    }

    public function countDataType3()
    {
        return DB::table(self::TABLE_NAME)
            ->where('type', 3)
            ->count();
    }

    public function getListData()
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getData()
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy('id', 'desc')
            ->get();
    }
}
