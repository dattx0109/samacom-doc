<?php


namespace App\Repository\CustomerPsychology;


use Illuminate\Support\Facades\DB;

class CustomerPsychologyRepository
{
    const TABLE_NAME = 'customer_psychology';

    public function insert($rawData)
    {
        if($rawData['type'] == 1){
            $rawData = [
                'ten_lien_lac'      => $rawData['fullNameContact'],
//                'gioi_tinh'         => (int)$rawData['genderContact'],
                'nam_sinh'          => $rawData['date_of_birth_contact'],
                'sdt'               => $rawData['phone_contact'],
                'email'             => $rawData['email_contact'],
                'nganh_dang_lam'    => $rawData['nganh_dang_lam'],
//                'vi_tri_sale'       => $rawData['vi_tri_sale'],
                'type'              => (int)$rawData['type'],
                'ten_KH'            => $rawData['full_name_kh'],
                'giong_noi_KH'      => (int)$rawData['giong_noi_kh'],
                'khuon_mat_KH'      => (int)$rawData['khuon_mat_kh'],
                'khi_chat_KH'       => (int)$rawData['khi_chat_kh'],
                'created_at'        => date("Y/m/d H:i:s"),
                'updated_at'        => date("Y/m/d H:i:s"),
            ];
            DB::table(self::TABLE_NAME)
                ->insert($rawData)
            ;
        }

        if($rawData['type'] == 2){
            $rawData = [
                'ten_lien_lac'          => $rawData['fullNameContact'],
//                'gioi_tinh'             => (int)$rawData['genderContact'],
                'nam_sinh'              => $rawData['date_of_birth_contact'],
                'sdt'                   => $rawData['phone_contact'],
                'email'                 => $rawData['email_contact'],
                'nganh_dang_lam'        => $rawData['nganh_dang_lam'],
//                'vi_tri_sale'           => $rawData['vi_tri_sale'],
                'type'                  => (int)$rawData['type'],
                'ten_KH'                => $rawData['full_name_kh'],
                'nam_sinh_KH'           => $rawData['nam_sinh_kh'],
                'linh_vuc_hoat_dong_KH' => $rawData['linh_vuc_kh'],
                'created_at'        => date("Y/m/d H:i:s"),
                'updated_at'        => date("Y/m/d H:i:s"),
            ];
            DB::table(self::TABLE_NAME)
                ->insert($rawData)
            ;
        }

        if($rawData['type'] == 3){
            $rawData = [
                'ten_lien_lac'          => $rawData['fullNameContact'],
//                'gioi_tinh'             => (int)$rawData['genderContact'],
                'nam_sinh'              => $rawData['date_of_birth_contact'],
                'sdt'                   => $rawData['phone_contact'],
                'email'                 => $rawData['email_contact'],
                'nganh_dang_lam'        => $rawData['nganh_dang_lam'],
//                'vi_tri_sale'           => $rawData['vi_tri_sale'],
                'type'                  => (int)$rawData['type'],
                'ten_KH'                => $rawData['full_name_kh'],
                'nam_sinh_KH'           => $rawData['nam_sinh_kh'],
                'gioi_tinh_KH'          => (int)$rawData['gioi_tinh_kh'],
                'khuon_mat_KH'          => (int)$rawData['khuon_mat_kh'],
                'created_at'        => date("Y/m/d H:i:s"),
                'updated_at'        => date("Y/m/d H:i:s"),
            ];
            DB::table(self::TABLE_NAME)
                ->insert($rawData)
            ;
        }
    }

    public function countDataType1()
    {
        return DB::table(self::TABLE_NAME)
            ->where('type', 1)
            ->count();
    }

    public function countDataType2()
    {
        return DB::table(self::TABLE_NAME)
            ->where('type', 2)
            ->count();
    }

    public function countDataType3()
    {
        return DB::table(self::TABLE_NAME)
            ->where('type', 3)
            ->count();
    }

    public function getListData()
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getData()
    {
        return DB::table(self::TABLE_NAME)
            ->orderBy('id', 'desc')
            ->get();
    }
}
