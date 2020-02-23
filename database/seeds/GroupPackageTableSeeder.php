<?php

use Illuminate\Database\Seeder;

class GroupPackageTableSeeder extends Seeder
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
                'name' => 'Gói đăng tin.',
                'description' => 'Cam kết 25 apply trong 10 ngày. Đảm bảo hoàn tiền nếu không hoàn thành cam kết với Doanh nghiệp.',
                'price_start' => '3500000',
                'price_end' => '8000000',
                'is_show' => '1',
                 'image' => 'img\job\group_view_cv.png',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],[
                'name' => 'Gói lọc CV.',
                'description' => 'Đặc biệt phù hợp với các công ty cần đội ngũ Sales đông đảo như Bất động sản, Bảo hiểm,.. <br/>Tiết kiệm 90% chi phí tuyển dụng nhân sự',
                'price_start' => '1200000',
                'price_end' => '8500000',
                'is_show' => '1',
                 'image' => 'img\job\group_post.png',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
            [
                'name' => 'Gói combo.',
                'description' => 'Dành cho các Doanh nghiệp đang trong tình trạng khan hiếm nhân lực Sales.<br/>Hỗ trợ Doanh nghiệp tăng hiệu quả tuyển dụng đồng thời giúp quảng bá thương hiệu.',
                'price_start' => '2450000',
                'price_end' => '8200000',
                'is_show' => '1',
                 'image' => 'img\job\group_combo.png',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
            [
                'name' => 'Gói ứng viên tham dự phỏng vấn.',
                'description' => 'Áp dụng với những Doanh nghiệp sử dụng gói đăng tin tại Samacom, tăng tỷ lệ Ứng viên tham dự phỏng vấn tới 90%',
                'price_start' => '260000',
                'price_end' => '260000',
                'is_show' => '1',
                'image' => 'img/job/group_tham_du_phong_van.png',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
            [
                'name' => 'Gói nhân sự tiêu chuẩn.',
                'description' => 'Cam kết 1 đổi 1 trong 10 ngày.<br/>Cam kết đưa đến cho doanh nghiệp Ứng viên đúng với nhu cầu và mong muốn của Doanh nghiệp.',
                'price_start' => '2860000',
                'price_end' => '2860000',
                'is_show' => '1',
                'image' => 'img/job/group_nhan_su_tieu_chuan.png',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
            [
                'name' => 'Gói đào tạo.',
                'description' => 'Giúp doanh nghiệp nâng cao 200% doanh số trong thời gian ngắn nhất.<br/>Giáo án và chương trình đào tạo được thiết kế dành riêng cho từng Doanh nghiệp',
                'price_start' => '699000',
                'price_end' => '90000000',
                'is_show' => '1',
                'image' => 'img/job/group_dao_tao.png',
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ],
        ];


        \DB::table('group_package')->insert($rawData);
    }
}
