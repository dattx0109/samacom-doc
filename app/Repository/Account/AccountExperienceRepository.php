<?php


namespace App\Repository\Account;


use Illuminate\Support\Facades\DB;

class AccountExperienceRepository
{
    const TABLE_NAME = 'account_experience';

    public function getListAccountByListPosition($listPosition)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('position', $listPosition)
            ->get()
            ;
    }

    public function getListAccountByListFieldWork($listFieldWork)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('field_work', $listFieldWork)
            ->get()
            ;
    }
}
