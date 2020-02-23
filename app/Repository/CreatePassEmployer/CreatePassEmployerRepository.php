<?php


namespace App\Repository\CreatePassEmployer;


use Illuminate\Support\Facades\DB;

class CreatePassEmployerRepository
{
    //const TABLE_NAME = 'create_pass_employer';
    const TABLE_NAME = 'employer_create_password';

    public function createTokenAfterRegisterEmployer($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insert($rawData)
            ;
    }
}
