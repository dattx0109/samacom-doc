<?php

namespace App\Service\Skill;

use App\Repository\Skill\SkillRepository;

class SkillService
{
    private $skillRepository;

    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function getList()
    {
        return $this->skillRepository->getList();

    }


}
