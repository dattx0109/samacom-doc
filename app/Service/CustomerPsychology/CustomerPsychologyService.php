<?php


namespace App\Service\CustomerPsychology;


use App\Repository\CustomerPsychology\CustomerPsychologyRepository;

class CustomerPsychologyService
{
    private $customerPsychologyRepository;
    public function __construct(CustomerPsychologyRepository $customerPsychologyRepository)
    {
        $this->customerPsychologyRepository = $customerPsychologyRepository;
    }

    public function insert($rawData)
    {
        $this->customerPsychologyRepository->insert($rawData);
    }

    public function countDataByType()
    {
        $tamLyKhType1 = $this->customerPsychologyRepository->countDataType1();
        $tamLyKhType2 = $this->customerPsychologyRepository->countDataType2();
        $tamLyKhType3 = $this->customerPsychologyRepository->countDataType3();
        return array($tamLyKhType1, $tamLyKhType2, $tamLyKhType3);
    }

    public function getListData(){
        return $this->customerPsychologyRepository->getListData();
    }

    public function getData(){
        return $this->customerPsychologyRepository->getData();
    }
}
