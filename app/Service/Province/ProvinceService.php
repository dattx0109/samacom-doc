<?php


namespace App\Service\Province;


use App\Repository\Province\ProvinceRepository;

class ProvinceService
{
    private $provinceRepository;

    public function __construct(ProvinceRepository $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    public function getList()
    {
        return $this->provinceRepository->getList();
    }
}
