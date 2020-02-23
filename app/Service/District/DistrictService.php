<?php


namespace App\Service\District;


use App\Repository\District\DistrictRepository;

class DistrictService
{
    private $districtRepository;

    public function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    public function getList($provinceId)
    {
        return $this->districtRepository->getList($provinceId);
    }
}
