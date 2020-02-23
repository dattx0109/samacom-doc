<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => 'nhan vien'.$i,
                'created_at' => '2019-08-02 09:20:38',
                'updated_at' => '2019-08-02 09:20:38',
            ];
            $listRawDataInsert[] = $rawData;
        }
        \DB::table('roles')->insert($listRawDataInsert);
    }
}
