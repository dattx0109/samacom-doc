<?php
namespace App\Repository\CharacterJob;
 use Illuminate\Support\Facades\DB;

 class CharacterJobRepository
 {
     const TABLE_NAME ='character_job';
     public function insert($dataInsert)
     {
         DB::table(self::TABLE_NAME)->insert($dataInsert);
     }
     public function deleteCharacterJob($jobId)
     {
         DB::table(self::TABLE_NAME)->where('job_id', $jobId)->delete();
     }
 }
