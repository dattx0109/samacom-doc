<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldWorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('field_work')->insert(
            [
                [
                    'name' => 'Du lịch & Nghỉ dưỡng (Nhà hàng, Khách sạn, Khu du lịch, Nghỉ dưỡng, …)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Bán lẻ/Bán sỉ/Thương mại',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Bảo hiểm (Nhân thọ/ Phi nhân thọ)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Bất động sản',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Kiến trúc/Thiết kế (Nhà phát triển, Kiến trúc/thiết kế, Dịch vụ bán/Quản lý/Cho thuê, …)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Công nghệ Phần mềm/Thiết bị phụ trợ',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Công nghệ Thông tin/Hạ tầng/Viễn thông',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Dầu khí/Năng lượng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Dệt may/Da giày',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Dịch vụ & Tư vấn (Luật, Nhân sự, Nghiên cứu thị trường, …)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Dịch vụ tài chính (Đầu tư, Kế toán, Kiểm toán, Chứng khoán, …)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Y tế/Dược',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Giáo dục/Đào tạo',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Hàng tiêu dùng (Thực phẩm & Phi thực phẩm)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Internet/Thương mại điện tử',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Kỹ thuật/Máy móc/Cơ khí Công nghiệp',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Ngân hàng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Nông nghiệp/Lâm/Ngư nghiệp',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Ô tô/Phụ tùng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Marketing/Pr/Truyền thông/Giải trí',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Sản xuất/Hóa chất',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Vận tải/Hậu cần (Xuất nhập khẩu, Vận chuyển tiếp vận, Giao nhận hàng hóa)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Xây dựng/Vật liệu (Nhà xây dựng, Nhà thầu thi công/giám sát, Sản xuất VLXD,…)',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
                ,
                [
                    'name' => 'Khác',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ]
            ]);
    }
}
