<?php


namespace App\Repository\Referral;


use App\Repository\Job\JobRepository;
use Illuminate\Support\Facades\DB;

class ReferralRepository
{
    const TABLE_NAME = 'referal_users';
    const TABLE_JOB_APPLY = 'job_applied';
    const TABLE_REFERRAL_USER = 'referal_user_job';
    const TABLE_ACCOUNT = 'accounts';

    public function countAccountJobShareReferralId($id)
    {
        return DB::table(self::TABLE_ACCOUNT)
            ->where('referral_user_id', $id)
            ->where('is_active', 1)
            ->count();
    }

    public function countAccountAllJobShareReferralId()
    {
        return DB::table(self::TABLE_ACCOUNT)
            ->where('referral_user_id', '<>', null)
            ->where('is_active', 1)
            ->count();
    }

    public function getAllReferralId()
    {
        return DB::table(self::TABLE_NAME)
            ->get();
    }

    public function countAllJobApply()
    {
        return DB::table(self::TABLE_JOB_APPLY)
            ->whereNotNull('referral_user_id')
            ->count()
        ;
    }

    public function countAllJobShare()
    {
        return DB::table(self::TABLE_REFERRAL_USER)
            ->count()
            ;
    }

    public function countReferralUserByReferralId($referralId)
    {
        return DB::table(self::TABLE_REFERRAL_USER)
            ->where('referal_user_id', $referralId)
            ->count()
        ;
    }

    public function countJobApplyByReferralId($referralId)
    {
        return DB::table(self::TABLE_JOB_APPLY)
            ->where('referral_user_id', $referralId)
            ->count()
        ;
    }

    public function getAllJobByReferralId($referralId)
    {
        return DB::table(self::TABLE_REFERRAL_USER)
            ->select(JobRepository::TABLE_NAME.'.title', JobRepository::TABLE_NAME.'.count_apply', JobRepository::TABLE_NAME.'.id')
            ->join(JobRepository::TABLE_NAME, JobRepository::TABLE_NAME.'.id', '=', self::TABLE_REFERRAL_USER.'.job_id')
            ->where(self::TABLE_REFERRAL_USER.'.referal_user_id', $referralId)
            ->get()
        ;
    }

    public function countJobApplyByReferralIdAndJobId($referralId, $jobId)
    {
        return DB::table(self::TABLE_JOB_APPLY)
            ->where('referral_user_id', $referralId)
            ->where('job_id', $jobId)
            ->count()
            ;
    }
}
