<?php

namespace App\Repository\User;

use Illuminate\Support\Facades\DB;

class CreateRepository
{
    const TABLE_NAME = 'users';
    const DEFAULT_PASSWORD = '123456789a';
    const MESSAGE_CREATE_SUCCESS = 'Tạo tài khoản thành công';

    public function insert($dataInsert)
    {
        DB::beginTransaction();
        try{
            $arrInsert = [
                'name' => $dataInsert['name'],
                'email' => $dataInsert['email'],
                'phone' => $dataInsert['phone'],
                'password' => \Hash::make(self::DEFAULT_PASSWORD),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table(self::TABLE_NAME)->insert($arrInsert);
            DB::commit();
            \Session::flash('message', self::MESSAGE_CREATE_SUCCESS);
            return;
        }catch (\Exception $e){

            DB::rollBack();
        }

    }
}
