<?php


namespace App\Repository\FieldWork;

use Illuminate\Support\Facades\DB;

class FieldWorkRepository
{
    const TABLE_NAME = 'field_work';

    public function getList()
    {
        return DB::table(self::TABLE_NAME)->orderBy('name')->get();
    }
}
