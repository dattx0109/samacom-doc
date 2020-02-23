<?php


namespace App\Repository\Account;


use Illuminate\Support\Facades\DB;

class AccountSkillRepository
{
    const TABLE_NAME = 'account_skill';

    public function getListAccountByListSkillId($listSkillId)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('skill_id', $listSkillId)
            ->get()
            ;
    }
}
