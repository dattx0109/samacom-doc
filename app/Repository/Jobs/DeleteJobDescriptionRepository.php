<?php

namespace App\Repository\Jobs;


use Illuminate\Support\Facades\DB;

class DeleteJobDescriptionRepository
{
    const TABLE_NAME = 'job_description';

    public function delete($jobDescriptionId)
    {
        return DB::table(self::TABLE_NAME)->where('id',$jobDescriptionId)->delete();
    }
}
