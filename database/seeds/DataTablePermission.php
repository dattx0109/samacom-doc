<?php

use Illuminate\Database\Seeder;

class DataTablePermission extends Seeder
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
                'name'                   => 'Xem danh sách user',
                'code'                   => 'user_sys_list_view',
                'permission_category_id' => 1
            ],
            [
                'name'                   => 'Xem chi tiết user',
                'code'                   => 'user_sys_detail_view',
                'permission_category_id' => 1
            ],
            [
                'name'                   => 'Thêm mới user',
                'code'                   => 'user_sys_detail_add',
                'permission_category_id' => 1
            ],
            [
                'name'                   => 'Xóa user',
                'code'                   => 'user_sys_detail_delete',
                'permission_category_id' => 1
            ],
            [
                'name'                   => 'Reset mật khẩu',
                'code'                   => 'user_reset_pass',
                'permission_category_id' => 1
            ],
            [
                'name'                   => 'Đổi mật khẩu',
                'code'                   => 'user_change_pass',
                'permission_category_id' => 1
            ],
            [
                'name'                   => 'Sửa thông tin user',
                'code'                   => 'user_sys_detail_update',
                'permission_category_id' => 1
            ],
            [
                'name'                   => 'Xem danh sách doanh nghiệp',
                'code'                   => 'company_sys_list_view',
                'permission_category_id' => 2
            ],[
                'name'                   => 'Thêm mới doanh nghiệp',
                'code'                   => 'company_sys_add',
                'permission_category_id' => 2
            ],
            [
                'name'                   => 'Xóa nhà doanh nghiệp',
                'code'                   => 'company_sys_delete',
                'permission_category_id' => 2
            ],
            [
                'name'                   => 'Chỉnh sửa thông tin doanh nghiệp',
                'code'                   => 'company_sys_detail_edit',
                'permission_category_id' => 2
            ],
            [
                'name'                   => 'Xem chi tiết thông tin doanh nghiệp',
                'code'                   => 'company_sys_detail_view',
                'permission_category_id' => 2
            ],
            [
                'name'                   => 'Gán/gỡ user quản trị doanh nghiệp',
                'code'                   => 'company_sys_user_control',
                'permission_category_id' => 2
            ],
            [
                'name'                   => 'Xem danh sách bài viết',
                'code'                   => 'content_sys_list_view',
                'permission_category_id' => 3
            ],
            [
                'name'                   => 'Xem chi tiết bài viết',
                'code'                   => 'content_sys_detail_view',
                'permission_category_id' => 3
            ],
            [
                'name'                   => 'Thêm mới bài viết',
                'code'                   => 'content_sys_detail_add',
                'permission_category_id' => 3
            ],
            [
                'name'                   => 'Chỉnh sửa chi tiết bài viết',
                'code'                   => 'content_sys_detail_edit',
                'permission_category_id' => 3
            ],
            [
                'name'                   => 'Xóa bài viết',
                'code'                   => 'content_sys_detail_delete',
                'permission_category_id' => 3
            ],
            [
                'name'                   => 'Xem danh sách matching',
                'code'                   => 'matching_sys_list_view',
                'permission_category_id' => 3
            ],
            [
                'name'                   => 'Chỉnh sửa chi tiết bài viết',
                'code'                   => 'matching_sys_detail_edit',
                'permission_category_id' => 3
            ],
            [
                'name'                   => 'Thêm luật matching',
                'code'                   => 'matching_sys_detail_add',
                'permission_category_id' => 4
            ],
            [
                'name'                   => 'Xóa luật matching',
                'code'                   => 'matching_sys_detail_delete',
                'permission_category_id' => 4
            ],
            [
                'name'                   => 'Xem danh sách ứng viên',
                'code'                   => 'employee_sys_list_view',
                'permission_category_id' => 5
            ],
            [
                'name'                   => 'Xem chi tiết ứng viên',
                'code'                   => 'employee_sys_detail_view',
                'permission_category_id' => 5
            ],
            [
                'name'                   => 'Chỉnh sửa chi tiết ứng viên',
                'code'                   => 'employee_sys_detail_edit',
                'permission_category_id' => 5
            ],
            [
                'name'                   => 'Thêm ứng viên',
                'code'                   => 'employee_sys_detail_add',
                'permission_category_id' => 5
            ],
            [
                'name'                   => 'Xóa ứng viên',
                'code'                   => 'employee_sys_detail_delete',
                'permission_category_id' => 5
            ],
            [
                'name'                   => 'Xem danh sách role',
                'code'                   => 'role_sys_list_view',
                'permission_category_id' => 6
            ],
            [
                'name'                   => 'Thêm role',
                'code'                   => 'role_sys_add',
                'permission_category_id' => 6
            ],
            [
                'name'                   => 'Sửa tên role',
                'code'                   => 'role_sys_name_edit',
                'permission_category_id' => 6
            ],
            [
                'name'                   => 'Cập nhật permission cho role',
                'code'                   => 'role_sys_permission_control',
                'permission_category_id' => 6
            ],
            [
                'name'                   => 'Xóa role',
                'code'                   => 'role_sys_delete',
                'permission_category_id' => 6
            ],
            [
                'name'                   => 'Xem danh sách job',
                'code'                   => 'job_sys_list_view',
                'permission_category_id' => 7
            ],
            [
                'name'                   => 'Xem chi tiết job',
                'code'                   => 'job_sys_detail_view',
                'permission_category_id' => 7
            ],
            [
                'name'                   => 'Thêm job mới',
                'code'                   => 'job_sys_detail_add',
                'permission_category_id' => 7
            ],
            [
                'name'                   => 'Chỉnh sửa chi tiết job',
                'code'                   => 'job_sys_detail_edit',
                'permission_category_id' => 7
            ],
            [
                'name'                   => 'Xóa job',
                'code'                   => 'job_sys_detail_delete',
                'permission_category_id' => 7
            ],
            [
                'name'                   => 'Ẩn job',
                'code'                   => 'job_sys_detail_hidden',
                'permission_category_id' => 7
            ],
            [
                'name'                   => 'Thêm mới product to employer',
                'code'                   => 'employer_sys_add_package_product',
                'permission_category_id' => 8
            ],
            [
                'name'                   => 'Danh sách employer use product',
                'code'                   => 'employer_sys_list_use_package_product',
                'permission_category_id' => 8
            ],


        ];
        $permissionRepository = new \App\Repository\Permission\PermissionRepository();
        $permissionRepository->insertPermissionByRawData($rawData);
    }
}
