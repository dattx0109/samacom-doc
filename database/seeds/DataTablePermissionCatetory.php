<?php

use App\Repository\PermissionCategory\PermissionCategoryRepository;
use Illuminate\Database\Seeder;

class DataTablePermissionCatetory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rawData = [
            [
                'id'   => 1,
                'name' => 'Tài khoản nội bộ'
            ],
            [
                'id'   => 2,
                'name' => 'Quản trị Doanh nghiệp nội bộ'
            ],
            [
                'id'   => 3,
                'name' => 'Quản trị bài viết nội bộ'
            ],
            [
                'id'   => 4,
                'name' => 'Matching'
            ],
            [
                'id'   => 5,
                'name' => 'Quản trị ứng viên - Nội bộ'
            ],
            [
                'id'   => 6,
                'name' => 'Quản trị Role'
            ],
            [
                'id'   => 7,
                'name' => 'Quản trị Job'
            ],
            [
                'id'   => 8,
                'name' => 'Quản trị Employer '
            ]
        ];

        $permissionCategoryRepository = new PermissionCategoryRepository();
        $permissionCategoryRepository->insertPermissionCategoryByRawData($rawData);
    }
}
