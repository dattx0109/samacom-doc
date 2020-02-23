<?php


namespace App\Repository\Package;


use Illuminate\Support\Facades\DB;

class PackageRepository
{
   const TABLE_NAME = 'package';

    public function getList()
    {
        return DB::table(self::TABLE_NAME)
            ->select('id','name')
            ->get();
   }


    public function detail($id)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id',$id)
            ->first();
    }
}
