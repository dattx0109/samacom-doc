<?php


namespace Tests\Unit\UserService;


use App\Repository\User\ShowDetailRepository;
use App\Service\User\DetailUserService;
use Psy\Exception\ErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class UserDetailServiceTest extends TestCase
{
    public function testGetDetailUserSuccess()
    {
        $rawDataMockDetail = [
        (object)[
            'id' => 2,
            'name' => 'Tienvm',
            'email' => 'tienvm.saf@gmail.com',
            'phone' => '0868888336',
            'deleted_by' => null,
            'role_id' => 50,
        ],
    ];

        $rawDataExpected = [
            "id" => 2,
            "name" => "Tienvm",
            "email" => "tienvm.saf@gmail.com",
            "phone" => "0868888336",
            "deleted_by" => null,
            "role_id" => 50,
            "role_name" => [
                50 => 50
            ]
        ];

        $userDetailRepositoryMock = $this->createMock(ShowDetailRepository::class);
        $userDetailRepositoryMock->method('detail')
            ->willReturn($rawDataMockDetail)
        ;
        $detailUserService = new DetailUserService($userDetailRepositoryMock);
        $result = $detailUserService->getDetail(2);
        $this->assertEquals($result, $rawDataExpected);
    }

    public function testGetDetailUserNullException()
    {
        $this->expectException(NotFoundHttpException::class);

        $rawDataMockDetail = [
        ];

        $userDetailRepositoryMock = $this->createMock(ShowDetailRepository::class);
        $userDetailRepositoryMock->method('detail')
            ->willReturn($rawDataMockDetail)
        ;
        $detailUserService = new DetailUserService($userDetailRepositoryMock);
        $detailUserService->getDetail(2);
    }
}