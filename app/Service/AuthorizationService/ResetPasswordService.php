<?php

namespace App\Service\AuthorizationService;

use App\Repository\User\CreateRepository;
use App\Repository\User\ResetPasswordRepository;

class ResetPasswordService
{
    private $repository;
    public function __construct(ResetPasswordRepository $repository)
    {
        $this->repository = $repository;
    }

    public function reset($id)
    {
        $this->repository->reset($id);
    }
}
