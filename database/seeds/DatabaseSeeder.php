<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataTablePermissionCatetory::class);
        $this->call(DataTablePermission::class);
        $this->call(User_RoleTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(Permission_RoleTableSeeder::class);
        $this->call(UsersAdminTableSeeder::class);
        $this->call(FieldWorkTableSeeder::class);
        $this->call(CharacterTableSeeder::class);
        $this->call(SkillTableSeeder::class);
        $this->call(PackegeSeeder::class);
        $this->call(EmployerPackageSeeder::class);
        $this->call(GroupPackageTableSeeder::class);


    }
}
