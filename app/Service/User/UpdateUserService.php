<?php

namespace App\Service\User;

use App\Repository\User\UpdateUserRepository;

class UpdateUserService
{
    private $updateUserRepository;
    public function __construct(UpdateUserRepository $updateUserRepository)
    {
        $this->updateUserRepository = $updateUserRepository;
    }
    public function update($dataUpdate, $id)
    {
        $this->updateUserRepository->update($dataUpdate, $id);
    }
}
