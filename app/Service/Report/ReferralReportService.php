<?php


namespace App\Service\Report;


use App\Repository\Referral\ReferralRepository;

class ReferralReportService
{

    private $referralRepository;

    public function __construct(ReferralRepository $referralRepository)
    {
        $this->referralRepository = $referralRepository;
    }

    public function countAllJobShare()
    {
        return $this->referralRepository->countAllJobShare();
    }

    public function countAllJobApply()
    {
        return $this->referralRepository->countAllJobApply();
    }

    public function getReferralReport()
    {
        $listReferralId = $this->referralRepository->getAllReferralId();
        return $this->refactorDataReferral($listReferralId);
    }

    public function refactorDataReferral($rawData)
    {
        $arrayNew = [];
        foreach ($rawData as &$item){
            $item->jobShare = $this->countShareJob($item->id);
            $item->jobApply = $this->countApplyJob($item->id);
            $item->jobRegister = $this->countAccountJobShareReferralId($item->id);
            $item = (array)$item;
            $arrayNew[] = $item;
        }
//        dd( $arrayNew);
        return $arrayNew;
    }

    public function countShareJob($referralId)
    {
        return $this->referralRepository->countReferralUserByReferralId($referralId);
    }

    public function countApplyJob($referralId)
    {
        return $this->referralRepository->countJobApplyByReferralId($referralId);
    }

    public function getAllJobByReferralId($referralId)
    {
        $listJob = $this->referralRepository->getAllJobByReferralId($referralId);

        foreach ($listJob as &$item){
            $item->count_apply = $this->countJobApplyByReferralIdAndJobId($referralId, $item->id);
        }

        return $listJob;
    }

    public function countAccountJobShareReferralId($id)
    {
        return $this->referralRepository->countAccountJobShareReferralId($id);
    }

    public function countAccountAllJobShareReferralId()
    {
        return $this->referralRepository->countAccountAllJobShareReferralId();
    }

    public function countJobApplyByReferralIdAndJobId($referralId, $jobId)
    {
        return $this->referralRepository->countJobApplyByReferralIdAndJobId($referralId, $jobId);
    }


}
