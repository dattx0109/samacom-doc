<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployerPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataInsert = [
            [
                'employer_id'=>1,
                'view_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'post_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'count_view_contact_profile'=>20,
                'count_post'=>30,
                'count_use_view'=>0,
                'count_use_post'=>0,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
            [
                'employer_id'=>2,
                'view_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'post_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'count_view_contact_profile'=>20,
                'count_post'=>30,
                'count_use_view'=>0,
                'count_use_post'=>0,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
            [
                'employer_id'=>3,
                'view_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'post_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'count_view_contact_profile'=>20,
                'count_post'=>30,
                'count_use_view'=>0,
                'count_use_post'=>0,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
            [
                'employer_id'=>4,
                'view_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'post_expired_at'=>date('Y-m-d', strtotime("+30 days")),
                'count_view_contact_profile'=>20,
                'count_post'=>30,
                'count_use_view'=>0,
                'count_use_post'=>0,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],

        ];
        DB::table('employer_package_current')->insert($dataInsert);
    }
}
