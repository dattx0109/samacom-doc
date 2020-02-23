<?php

namespace App\Service\User;


use App\Repository\User\DeleteRepository;

class DestroyUserService
{
    private $deleteUserRepository;
    public function __construct(DeleteRepository $deleteUserRepository)
    {
        $this->deleteUserRepository = $deleteUserRepository;
    }

    public function delete($id)
    {
       return  $this->deleteUserRepository->delete($id);
    }
}
