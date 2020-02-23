<?php


namespace App\Service\Package;


use App\Repository\Package\PackageRepository;

class PackageService
{
    private  $packageRepository;
    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function getList()
    {
        return $this->packageRepository->getList();
    }

    public function detail($id)
    {
        return $this->packageRepository->detail($id);
    }
}
