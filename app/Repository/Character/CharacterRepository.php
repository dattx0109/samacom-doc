<?php


namespace App\Repository\Character;


use Illuminate\Support\Facades\DB;

class CharacterRepository
{
    const TABLE_NAME = 'character';

    public function getList()
    {
        return DB::table(self::TABLE_NAME)->get();
    }
}
