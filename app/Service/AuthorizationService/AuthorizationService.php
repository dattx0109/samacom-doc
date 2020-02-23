<?php


namespace App\Service\AuthorizationService;


use App\Repository\Permission\PermissionRepository;
use App\Repository\RoleUser\RoleUserRepository;

class AuthorizationService
{

    private $permissionName;
    private $user;

    public function author($permissionCode)
    {
        $userLogin = request()->user;

        $isAccess = $this
            ->setUserLogin($userLogin)
            ->setPermissionName($permissionCode)
            ->checkPermission();
        if (!$isAccess) {
            return view('error.403');
        }
    }

    public function setPermissionName($name)
    {
        $this->permissionName = $name;
        return $this;
    }

    public function setUserLogin($user)
    {
        $this->user = $user;
        return $this;
    }

    public function checkPermission()
    {
        $userRoleRepository   = new RoleUserRepository();
        $listRoleId           = $userRoleRepository->getAllRoleByUserId($this->user->id);

        $permissionRepository = new PermissionRepository();

        $isPermission = $permissionRepository->checkPermissionByCodeAndRole($listRoleId, $this->permissionName);

        return ($isPermission > 0) ? true : false;
    }
}
