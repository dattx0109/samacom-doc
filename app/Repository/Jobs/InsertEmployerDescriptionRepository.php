<?php


namespace App\Repository\Jobs;


use Illuminate\Support\Facades\DB;

class InsertEmployerDescriptionRepository
{
    const TABLE_NAME = 'employee_description';

    public function insert($rawData)
    {
       return DB::table(self::TABLE_NAME)->insertGetId([
            'degree' => $rawData['degree'],
            'experience' => $rawData['experience'],
//            'appearance' => $rawData['appearance'],
//            'voice' => $rawData['voice'],
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);;
    }
}
