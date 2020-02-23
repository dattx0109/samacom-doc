<?php


namespace App\Service\FieldWork;


use App\Repository\FieldWork\FieldWorkRepository;

class FieldWorkService
{
    private $fieldWorkRepository;
    public function __construct(FieldWorkRepository $fieldWorkRepository)
    {
        $this->fieldWorkRepository = $fieldWorkRepository;
    }
    public function getList()
    {
        return $this->fieldWorkRepository->getList();
    }

}
