<?php


namespace App\Service\job;

use App\Repository\Job\ListEmployesApplyJobRepository;

class ListEmployesApplyJobService
{
    private $listUvApplayJob;

    public function __construct(ListEmployesApplyJobRepository $listUvApplayJob)
    {
        $this->listUvApplayJob = $listUvApplayJob;
    }

    public function getListUVApplyJob($id)
    {
        return $this->listUvApplayJob->getListUVApplyJob($id);
    }
}
