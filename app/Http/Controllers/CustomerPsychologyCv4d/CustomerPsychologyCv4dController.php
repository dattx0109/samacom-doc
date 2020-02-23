<?php


namespace App\Http\Controllers\CustomerPsychologyCv4d;


use App\Service\CustomerPsychology\CustomerPsychologyService;
use App\Service\cv4d\Cv4dService;

class CustomerPsychologyCv4dController
{
    private $customerPsychologyService;
    private $cv4dService;

    public function __construct(
        CustomerPsychologyService $customerPsychologyService,
        Cv4dService $cv4dService
    )
    {
        $this->customerPsychologyService = $customerPsychologyService;
        $this->cv4dService = $cv4dService;
    }

    public function countDataByType()
    {
        $listCountTamLy = $this->customerPsychologyService->countDataByType();
        $listCountCv4d = $this->cv4dService->countDataByType();
        return view('tamlyCv4d.count-tamly-cv4d', [
               'listCountTamLy' => $listCountTamLy,
                'listCountCv4d' => $listCountCv4d
        ]);
    }

}
