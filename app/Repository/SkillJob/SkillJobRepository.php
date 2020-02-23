<?php
namespace App\Repository\SkillJob;
use Illuminate\Support\Facades\DB;

class SkillJobRepository
{
    const TABLE_NAME ='skill_job';
    public function insert($dataInsert)
    {
        DB::table(self::TABLE_NAME)->insert($dataInsert);
    }
    public function deleteSkillJob($jobId)
    {
        DB::table(self::TABLE_NAME)->where('job_id', $jobId)->delete();

    }

}
