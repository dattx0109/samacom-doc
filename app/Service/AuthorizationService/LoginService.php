<?php


namespace App\Service\AuthorizationService;


use App\Repository\Login\LoginRepository;

class LoginService
{
    private $loginRepository;
    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function findUserByEmail($email)
    {
        return $this->loginRepository->findUserByEmail($email);
    }
}
