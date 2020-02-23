<?php

use Illuminate\Database\Seeder;

class   UsersAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rawData = [
            'email' => 'admin@samacom.com.vn',
            'password' => bcrypt('admin654321')
        ];
        \DB::table('users')->insert($rawData);
        $user = \DB::table('users')->where('email', 'admin@samacom.com.vn') -> first();

        $rawDataRole = [
            'name' => 'Admin',
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s"),
        ];

        \DB::table('roles')->insert($rawDataRole);

        $roleAdmin = \DB::table('roles')->where('name','Admin')->first();
        \DB::table('user_role')->insert(['user_id'=> $user->id, 'role_id' => $roleAdmin->id]);
        $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39);
        for($i=0; $i<=31; $i++) {
            \DB::table('permission_role')->insert(['permission_id' => $array[$i], 'role_id' => $roleAdmin->id]);
        }
        \DB::table('user_role')->insert(['user_id'=> $user->id, 'role_id' => $roleAdmin->id]);

    }
}
