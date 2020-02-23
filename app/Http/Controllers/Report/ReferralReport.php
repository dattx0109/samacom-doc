<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Service\Report\ReferralReportService;

class ReferralReport extends Controller
{
    private $referralReportService;

    public function __construct(ReferralReportService $referralReportService)
    {
        $this->referralReportService = $referralReportService;
    }

    public function getAllUserReferral()
    {
        $countJobShare = $this->referralReportService->countAllJobShare();
        $countJobApply = $this->referralReportService->countAllJobApply();

        $rawData = $this->referralReportService->getReferralReport();

        // sort order by key
        if(request()->share == 1){
            usort($rawData, function ($item1, $item2) {
                return $item1['jobShare'] <=> $item2['jobShare'];
            });
        }
        if(request()->share == 2){
            usort($rawData, function ($item1, $item2) {
                return $item2['jobShare'] <=> $item1['jobShare'];
            });
        }

        if(request()->apply == 1){
            usort($rawData, function ($item1, $item2) {
                return $item1['jobApply'] <=> $item2['jobApply'];
            });
        }
        if(request()->apply == 2){
            usort($rawData, function ($item1, $item2) {
                return $item2['jobApply'] <=> $item1['jobApply'];
            });
        }

        $countAccountRegisterAll = $this->referralReportService->countAccountAllJobShareReferralId();
        return view('reports.report-referral', [
            'listReferral'  => $rawData,
            'countJobShare' => $countJobShare,
            'countJobApply' => $countJobApply,
            'countAccountRegisterAll' => $countAccountRegisterAll
        ]);
    }

    public function getAllJobByReferralId()
    {
        $referralId = request()->input('referralId');
        $allJobs = $this->referralReportService->getAllJobByReferralId($referralId);
        return response()->json($allJobs);
    }
}
