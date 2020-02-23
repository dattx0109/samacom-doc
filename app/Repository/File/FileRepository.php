<?php


namespace App\Repository\File;


use Illuminate\Support\Facades\DB;

class FileRepository
{
    const TABLE_NAME = 'files';

    public function insert($rawData)
    {
        return DB::table(self::TABLE_NAME)->insertGetId($rawData);
    }

}
