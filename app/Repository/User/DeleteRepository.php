<?php

namespace App\Repository\User;

use Illuminate\Support\Facades\DB;

class DeleteRepository
{
    const TABLE_NAME = 'users';


    public function delete($id)
    {
        $checkUser = DB::table(self::TABLE_NAME)->where('id', $id)->whereNull('deleted_by')->count();
        if ($checkUser == 0) {
            return response()->json(['message' => 'Not Found!'], 404);
        }
        DB::beginTransaction();
        try {
            DB::table(self::TABLE_NAME)->where('id', $id)->update([
                'deleted_at' => date("Y/m/d H:i:s"),
                'deleted_by' => \Session::get('user')->id
            ]);
            DB::commit();
            return;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
