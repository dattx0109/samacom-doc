<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('character')->insert(
            [
                [
                    'name' => 'Nhất quán',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Kiên trì, Bền bỉ',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tính mục tiêu',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tỉ mỉ, chi tiết, rõ ràng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Trung thành',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Thích tạo sự ảnh hưởng',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Năng động/Tích cực vận động',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quảng giao/Dễ kết bạn',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Hoạt ngôn',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Quyết đoán',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Cầu tiến',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Linh hoạt',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Lạc quan, yêu đời',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tự tạo động lực',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Tự tin',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Hài hước/ Vui vẻ',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Bình tĩnh, chắc chắn',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
                [
                    'name' => 'Chu đáo, Tận tụy',
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ],
            ]);
    }
}
