<?php


namespace App\Service\cv4d;


use App\Repository\cv4d\Cv4dRepository;

class Cv4dService
{
    private $cv4dRepository;

    public function __construct(Cv4dRepository $cv4dRepository)
    {
        $this->cv4dRepository = $cv4dRepository;
    }

    public function insertCv4($rawData)
    {
       return $this->cv4dRepository->insertCv4($rawData);
    }

    public function getCv4d()
    {
       return $this->cv4dRepository->getCv4d();
    }

    public function countDataByType()
    {
        $Cv4dType1 = $this->cv4dRepository->countDataType1();
        $Cv4dType2 = $this->cv4dRepository->countDataType2();
        $Cv4dType3 = $this->cv4dRepository->countDataType3();
        return array($Cv4dType1, $Cv4dType2, $Cv4dType3);
    }

    public function getListData()
    {
        return $this->cv4dRepository->getListData();
    }

    public function getData()
    {
        return $this->cv4dRepository->getData();
    }
}
