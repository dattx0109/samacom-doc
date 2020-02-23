<?php


namespace App\Service\job;


use App\Repository\Jobs\InsertJobDescriptionRepository;

class JobDescriptionService
{
    private $insertJobDescriptionRepository;

    public function __construct(InsertJobDescriptionRepository $insertJobDescriptionRepository)
    {
        $this->insertJobDescriptionRepository = $insertJobDescriptionRepository;
    }

    public function insert($rawData)
    {
      return  $this->insertJobDescriptionRepository->insert($rawData);
    }
}
