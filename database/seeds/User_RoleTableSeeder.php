<?php

use Illuminate\Database\Seeder;

class User_RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listRawDataInsert = [];
        for ($i = 1; $i < 50; $i++){
            $rawData = [
                'user_id' => $i,
                'role_id' => $i
            ];
            $listRawDataInsert[] = $rawData;
        }
        \DB::table('user_role')->insert($listRawDataInsert);
    }
}
