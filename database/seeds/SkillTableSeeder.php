<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill')->insert(
            [
                [
                    'name' => 'Sáng tạo nội dung',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Lắng nghe',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Thấu hiểu',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tư vấn',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Thuyết trình',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Đàm phán',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Chốt đơn hàng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Xử lý từ chối',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản lý đơn hàng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Điều phối đơn hàng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Xây dựng mối quan hệ',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Chăm sóc khách hàng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Làm việc nhóm',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản trị cảm xúc',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản lý thời gian',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản trị giọng nói',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tìm kiếm thông tin',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Phân tích dữ liệu',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Nghiên cứu thị trường',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Ghi nhớ tốt',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quan sát',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Bao quát',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Thu mua',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Trưng bày sản phẩm',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Giám sát công việc',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Phân bổ nguồn lực',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản lý con người',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản lý chi phí',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản lý hàng hoá, kho vận',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản lý công nợ',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quản trị thay đổi',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tạo động lực',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Gây ảnh hưởng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Xây dựng mục tiêu',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Lập kế hoạch kinh doanh',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Xây dựng quy trình',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Xây dựng chính sách',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tuyển dụng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
            ]);
    }
}
