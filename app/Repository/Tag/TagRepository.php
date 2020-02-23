<?php


namespace App\Repository\Tag;


use Illuminate\Support\Facades\DB;

class TagRepository
{
    const TABLE_NAME = 'tags';

    public function insert($dataInsert)
    {
        DB::table(self::TABLE_NAME)->insert($dataInsert);
    }
    public function delete($JobId)
    {
        DB::table(self::TABLE_NAME)->where('job_id',$JobId)->delete();
    }
}
