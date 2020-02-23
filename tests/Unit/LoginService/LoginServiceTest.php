<?php


namespace Tests\Unit\LoginService;


use App\Repository\Login\LoginRepository;
use App\Service\AuthorizationService\LoginService;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    public function testFindUserByEmail()
    {
        $user = [
            (object) [
                'id'    => 1,
                'name'  => 'user1',
                'email' => 'user1@samacom.com.vn',
                'phone' => '123456781',
                'password' => '$2y$10$zhRaXOg/6YCQtOSm0ZLDzeAnqzfTH7vZoJPpDESDwtyqkkZQC.Zkm'
            ],
        ];

        $userExpected = [
            (object) [
                'id'    => 1,
                'name'  => 'user1',
                'email' => 'user1@samacom.com.vn',
                'phone' => '123456781',
                'password' => '$2y$10$zhRaXOg/6YCQtOSm0ZLDzeAnqzfTH7vZoJPpDESDwtyqkkZQC.Zkm'
            ]
        ];

        $userRepositoryMock = $this->createMock(LoginRepository::class);
        $userRepositoryMock->method('findUserByEmail')
        ->willReturn($user)
        ;

        $loginService = new LoginService($userRepositoryMock);
        $result = $loginService->findUserByEmail('user3@samacom.com.vn');
        $this->assertEquals($result, $userExpected);
    }
}
