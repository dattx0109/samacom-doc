<?php

namespace App\Service\User;

use App\Repository\User\CreateRepository;

class CreateUserService
{
    private $createUser;
    public function __construct(CreateRepository $createUser)
    {
        $this->createUser = $createUser;
    }

    public function create($dataInsert)
    {
        $this->createUser->insert($dataInsert);
    }
}
