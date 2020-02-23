<?php


namespace App\Http\Controllers\Employer;


use App\Repository\Employer\EmployerFromLandingPageRepository;
use App\Service\Employer\EmployerFromLandingPageService;

class EmployerFromLandingPageController
{

    private $employerFromLandingPageService;

    public function __construct(EmployerFromLandingPageService $employerFromLandingPageService)
    {
        $this->employerFromLandingPageService = $employerFromLandingPageService;
    }

    public function listEmployerFromLandingPage()
    {
        $listEmployer = $this->employerFromLandingPageService->getList();
        return view('employer.list-employer-from-landing-page',[
            'listEmployer' => $listEmployer
        ]);
    }

    public function advisoryEmployPackage($id)
    {
        $this->employerFromLandingPageService->UpdateStatusEmployerRequest(request()->all(),$id);
    }
}
