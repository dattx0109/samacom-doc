<?php

namespace App\Repository\Jobs;


use Illuminate\Support\Facades\DB;

class InsertJobDescriptionRepository
{
    const TABLE_NAME = 'job_description';

    public function insert($rawData)
    {
        return DB::table(self::TABLE_NAME)->insertGetId([
            'description' => $rawData['description'],
            'requirements' => $rawData['requirements'],
            'benefit' => $rawData['benefit'],
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);
    }
}
