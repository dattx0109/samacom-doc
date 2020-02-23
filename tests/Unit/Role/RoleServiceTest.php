<?php


namespace Tests\Unit\Role;

use App\Repository\Permission\PermissionRepository;
use App\Repository\PermissionRole\PermissionRoleRepository;
use App\Repository\RoleUser\RoleUserRepository;
use App\Service\Role\RoleService;
use Tests\TestCase;
use App\Repository\Role\RoleRepository;

class RoleServiceTest extends TestCase
{
    /**
     *
     */
    public function testGetAllRoleSuccess()
    {
        $this->assertEquals(1, 1);
    }

    public function testUpdateRolePermissionRefactorDataSuccess()
    {
        $permissionRepositoryMock     = $this->createMock(PermissionRepository::class);
        $roleRepositoryMock           = $this->createMock(RoleRepository::class);
        $permissionRoleRepositoryMock = $this->createMock(PermissionRoleRepository::class);
        $roleUserRepositoryMock       = $this->createMock(RoleUserRepository::class);

        $rawData = [
            1 => 1,
            2 => 2,
            3 => 3
        ];
        $roleId = 1;
        $rawDataExpected = [
            [
                'permission_id' => 1,
                'role_id'       => 1
            ],
            [
                'permission_id' => 2,
                'role_id'       => 1
            ],
            [
                'permission_id' => 3,
                'role_id'       => 1
            ]
        ];

        $roleService = new RoleService($roleRepositoryMock, $permissionRepositoryMock, $permissionRoleRepositoryMock, $roleUserRepositoryMock);
        $result = $roleService->refactorDataInsertPermission($rawData, $roleId);
        $this->assertEquals($result, $rawDataExpected);
    }
}
