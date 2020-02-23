<?php


namespace App\Repository\Job;

use App\Repository\Account\AccountDetailRepository;
use App\Repository\Account\AccountRepository;
use Illuminate\Support\Facades\DB;

class ListEmployesApplyJobRepository
{
    const TABLE_NAME = 'job_applied';
    const TABLE_NAME_ACCOUNTS = 'accounts';
    const TABLE_NAME_ACCOUNTS_DETAIL = 'account_detail';

    public function getListUVApplyJob($id)
    {
        $query = DB::table(self::TABLE_NAME)
            ->Join(
                AccountRepository::TABLE_NAME,
                AccountRepository::TABLE_NAME.'.id',
                '=',
                self::TABLE_NAME.'.account_id'
            )
            ->Join(
                AccountDetailRepository::TABLE_NAME,
                AccountDetailRepository::TABLE_NAME.'.account_id',
                '=',
                AccountRepository::TABLE_NAME.'.id'
            )
            ->select(
                AccountDetailRepository::TABLE_NAME.'.job_search_status',
                self::TABLE_NAME.'.created_at as ngay_apply_job',
                AccountRepository::TABLE_NAME.'.name',
                AccountRepository::TABLE_NAME.'.email',
                AccountRepository::TABLE_NAME.'.phone'
            )
            ->where(self::TABLE_NAME.'.job_id', $id);
        return $query->paginate();
    }

    public function countApplyJob()
    {
        return DB::table('job_applied')
            ->select(DB::raw('count(*) as count , job_id'))
            ->groupBy('job_id')->get()->toArray();
    }
}
