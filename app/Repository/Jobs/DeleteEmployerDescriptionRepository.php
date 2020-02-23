<?php


namespace App\Repository\Jobs;


use Illuminate\Support\Facades\DB;

class DeleteEmployerDescriptionRepository
{
    const TABLE_NAME = 'employee_description';

    public function delete($employeeDescriptionId)
    {
       return DB::table(self::TABLE_NAME)->where('id',$employeeDescriptionId)->delete();
    }
}
