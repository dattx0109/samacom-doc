<?php


namespace App\Repository\RecruitmentEmployee;


use Illuminate\Support\Facades\DB;

class RecruitmentEmployeeRepository
{
    const TABLE_NAME        = 'referal_users';
    const DEFAULT_PASSWORD  = 'samacom123456';

    public function create($rawData)
    {
        $rawData =[
            'phone' => $rawData['phone'],
            'name'  => $rawData['name'],
            'email' => $rawData['email'],
            'password' => \Hash::make(self::DEFAULT_PASSWORD),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        return DB::table(self::TABLE_NAME)
            ->insertGetId($rawData)
        ;
    }
}
