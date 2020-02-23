<?php

use Illuminate\Database\Seeder;

class Permission_RoleTableSeeder extends Seeder
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
                'permission_id' => $i,
                'role_id' => $i
            ];
            $listRawDataInsert[] = $rawData;
        }
        \DB::table('permission_role')->insert($listRawDataInsert);
    }
}
