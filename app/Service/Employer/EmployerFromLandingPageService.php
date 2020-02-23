<?php


namespace App\Service\Employer;


use App\Repository\Employer\EmployerFromLandingPageRepository;

class EmployerFromLandingPageService
{
    private $employerFromLandingPageRepository;

    public function __construct(EmployerFromLandingPageRepository $employerFromLandingPageRepository)
    {
        $this->employerFromLandingPageRepository = $employerFromLandingPageRepository;
    }

    public function getList()
    {
       return $this->employerFromLandingPageRepository->getList();
    }

    public function UpdateStatusEmployerRequest($rawData,$id)
    {
        $rawDataInsert = [
            'status' => $rawData['status'],
            'updated_at' => date("Y/m/d H:i:s")
        ];
        return $this->employerFromLandingPageRepository->UpdateStatusEmployerRequest($rawDataInsert, $id);
    }
}
