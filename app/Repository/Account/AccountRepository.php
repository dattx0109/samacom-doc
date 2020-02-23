<?php
/**
 * Created by PhpStorm.
 * User: thanhvuminh
 * Date: 9/23/19
 * Time: 10:01 AM
 */

namespace App\Repository\Account;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AccountRepository
{
    const TABLE_NAME = 'accounts';
    const ITEM_PER_PAGE = 10;
    const STATUS_ACTIVE = 1;
    const ACCOUNT_BACKUP = 1;
    const FIRST_LOGIN = 1;
    const IS_SHOW =null;
    const IS_HIDE =2;

    public function filterAccount($rawData)
    {
        $listJob = DB::table(AccountDetailRepository::TABLE_NAME)
            ->leftJoin(
                self::TABLE_NAME,
                self::TABLE_NAME . '.id',
                '=',
                AccountDetailRepository::TABLE_NAME . '.account_id'
            )
            ->leftJoin(
                AccountWishRepository::TABLE_NAME,
                self::TABLE_NAME . '.id',
                '=',
                AccountWishRepository::TABLE_NAME . '.account_id'
            )
            ->select(
                self::TABLE_NAME . '.name',
                self::TABLE_NAME . '.id',
                self::TABLE_NAME . '.email',
                self::TABLE_NAME . '.phone',
                self::TABLE_NAME.'.is_active',
                self::TABLE_NAME.'.is_active',
                self::TABLE_NAME.'.is_show',
                self::TABLE_NAME.'.created_at',
                AccountDetailRepository::TABLE_NAME . '.province_id as province_id_current',
                AccountDetailRepository::TABLE_NAME . '.district_id as district_id_current',
                AccountDetailRepository::TABLE_NAME . '.gender',
                AccountDetailRepository::TABLE_NAME . '.date_of_birth',
                AccountDetailRepository::TABLE_NAME . '.job_search_status',
                AccountDetailRepository::TABLE_NAME . '.avatar',
                AccountWishRepository::TABLE_NAME . '.filed_work_wish',
                AccountWishRepository::TABLE_NAME . '.position_wish',
                AccountWishRepository::TABLE_NAME . '.salary_wish',
                AccountWishRepository::TABLE_NAME . '.province_id',
                AccountWishRepository::TABLE_NAME . '.district_id'
            );
        if (isset($rawData['name'])) {
            $name = $rawData['name'];
            $listJob->where(function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%')
                    ->orWhere('phone', 'like', '%' . $name . '%');
            });
        }
        if (isset($rawData['province_id'])) {
            $listJob->where(AccountDetailRepository::TABLE_NAME . '.province_id', $rawData['province_id']);
        }
        if (isset($rawData['district_id'])) {
            $listJob->where(AccountDetailRepository::TABLE_NAME . '.district_id', $rawData['district_id']);
        }
        if (isset($rawData['gender'])) {
            $listJob->where(AccountDetailRepository::TABLE_NAME . '.gender', $rawData['gender']);
        }
        if (isset($rawData['is_married'])) {
            $listJob->where(AccountDetailRepository::TABLE_NAME . '.marital_status', $rawData['is_married']);
        }
        if (isset($rawData['job_search_status'])) {
            $listJob->where(AccountDetailRepository::TABLE_NAME . '.job_search_status', $rawData['job_search_status']);
        }
        if (isset($rawData['position_exp']) && !empty($rawData['position_exp'])) {
            $listJob->whereIn(self::TABLE_NAME . '.id', $rawData['listAccountIdPosition']);
        }
        if (isset($rawData['field_exp']) && !empty($rawData['field_exp'])) {
            $listJob->whereIn(self::TABLE_NAME . '.id', $rawData['listAccountIdFieldWork']);
        }
        if (isset($rawData['skill']) && !empty($rawData['skill'])) {
            $listJob->whereIn(self::TABLE_NAME . '.id', $rawData['listAccountIdSkill']);
        }
        if (isset($rawData['degree_edu']) && !empty($rawData['degree_edu'])) {
            $listJob->whereIn(self::TABLE_NAME . '.id', $rawData['listAccountIdDegree']);
        }
        if (isset($rawData['salary']) && !empty($rawData['salary'])) {
            $salary = $rawData['salary'];
            $listJob->where(function ($query) use ($salary) {
                if (in_array(1, $salary)) {
                    $query->whereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [0, 6000000]);
                }
                if (in_array(2, $salary)) {
                    $query->orwhereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [6000000, 8000000]);
                }
                if (in_array(3, $salary)) {
                    $query->orwhereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [8000000, 10000000]);
                }
                if (in_array(4, $salary)) {
                    $query->orwhereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [10000000, 15000000]);
                }
                if (in_array(5, $salary)) {
                    $query->orwhereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [15000000, 20000000]);
                }
                if (in_array(6, $salary)) {
                    $query->orwhereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [20000000, 30000000]);
                }
                if (in_array(7, $salary)) {
                    $query->orwhereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [30000000, 50000000]);
                }
                if (in_array(8, $salary)) {
                    $query->orwhereBetween(AccountWishRepository::TABLE_NAME . '.salary_wish', [50000000, 100000000]);
                }
                if (in_array(9, $salary)) {
                    $query->orwhere(AccountWishRepository::TABLE_NAME . '.salary_wish', '>=',100000000);
                }
            });
        }
        if (isset($rawData['position_wish']) && !empty($rawData['position_wish'])) {
            $listJob->whereIn(AccountWishRepository::TABLE_NAME . '.position_wish', $rawData['position_wish']);
        }
        if (isset($rawData['field_wish']) && !empty($rawData['field_wish'])) {
            $listJob->whereIn(AccountWishRepository::TABLE_NAME . '.filed_work_wish', $rawData['field_wish']);
        }
        $listJob =  $listJob
            ->orderBy(self::TABLE_NAME . '.updated_at', 'desc')
            ->paginate(self::ITEM_PER_PAGE);
        $cache = Cache::remember('cache',Carbon::now()->addMinutes(1),function () use ($listJob){
                return $listJob;
        });
        return $cache;
//        return $listJob
//            ->orderBy(self::TABLE_NAME . '.updated_at', 'desc')
//            ->paginate(self::ITEM_PER_PAGE);
    }
    public function logFistLoginAccountBackup($email)
    {
        return DB::table(self::TABLE_NAME)
            ->where('email', $email)
            ->where('account_type', self::ACCOUNT_BACKUP)
            ->update(['fist_login_account_backup'=> self::FIRST_LOGIN]);
    }
    public function showAccount($id)
    {
        DB::table(self::TABLE_NAME)->where('id', $id)->update(['is_show'=>self::IS_SHOW]);
    }
    public function hideAccount($id)
    {
        DB::table(self::TABLE_NAME)->where('id', $id)->update(['is_show'=>self::IS_HIDE]);
    }
}
