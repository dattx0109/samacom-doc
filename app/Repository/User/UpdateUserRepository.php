<?php

namespace App\Repository\User;

use Illuminate\Support\Facades\DB;


class UpdateUserRepository
{
    const TABLE_NAME = 'users';
    const ROLE_USER_TABLE = 'user_role';

    public function update($dataUpdate, $id)
    {
        $checkUser = DB::table(self::TABLE_NAME)->where('id', $id)->count();
        if ($checkUser == 0) {
            return response()->json(['message' => 'Not Found!'], 404);
        }
        DB::beginTransaction();
        try {
            $dataRoleUsers = [];
            foreach ($dataUpdate['role'] as $item) {
                $dataRoleUsers[] = ['user_id' => $id, 'role_id' => $item];
            }
            DB::table(self::ROLE_USER_TABLE)->where('user_id', $id)->delete();
            DB::table(self::ROLE_USER_TABLE)->insert($dataRoleUsers);
            DB::table(self::TABLE_NAME)->where('id', $id)->update([
                'name' => $dataUpdate['name'],
                'email' => $dataUpdate['email'],
                'phone' => $dataUpdate['phone'],
                'updated_by'=>\Session::get('user')->id,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
        }
    }
}

