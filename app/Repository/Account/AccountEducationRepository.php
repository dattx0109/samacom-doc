<?php


namespace App\Repository\Account;


use Illuminate\Support\Facades\DB;

class AccountEducationRepository
{
    const TABLE_NAME = 'account_education';

    public function getListAccountByListDegree($listDegree)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('degree', $listDegree)
            ->get()
            ;
    }
}
