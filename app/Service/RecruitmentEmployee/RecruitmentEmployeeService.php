<?php


namespace App\Service\RecruitmentEmployee;

use App\Repository\RecruitmentEmployee\RecruitmentEmployeeRepository;

class RecruitmentEmployeeService
{

    private $recruitmentEmployeeRepository;

    public function __construct(RecruitmentEmployeeRepository $recruitmentEmployeeRepository)
    {
        $this->recruitmentEmployeeRepository = $recruitmentEmployeeRepository;
    }

    public function create($rawData)
    {
        $this->recruitmentEmployeeRepository->crate($rawData);
    }
}
