<?php


namespace App\Service\Role;


use App\Repository\Permission\PermissionRepository;
use App\Repository\PermissionRole\PermissionRoleRepository;
use App\Repository\Role\RoleRepository;
use App\Repository\RoleUser\RoleUserRepository;

class RoleService
{
    private $roleRepository;
    private $permissionRepository;
    private $permissionRoleRepository;
    private $roleUserRepository;

    public function __construct(
            RoleRepository $roleRepository,
            PermissionRepository $permissionRepository,
            PermissionRoleRepository $permissionRoleRepository,
            RoleUserRepository $roleUserRepository
    )
    {
        $this->roleRepository           = $roleRepository;
        $this->permissionRepository     = $permissionRepository;
        $this->permissionRoleRepository = $permissionRoleRepository;
        $this->roleUserRepository       = $roleUserRepository;
    }

    public function getListRole()
    {
        return $this->roleRepository->getAllRole();
    }

    public function getAllRole()
    {
        return $this->roleRepository->getAllRoleNotPage();
    }

    public function deleteRoleByRoleId($roleId)
    {
        $this->roleRepository->deleteRoleByRoleId($roleId);
        $this->roleUserRepository->deleteRoleId($roleId);
        $this->permissionRoleRepository->deleteUserRoleByRoleId($roleId);
    }

    public function getDetailRole()
    {
        $this->roleRepository->getAllRole();
    }

    public function getAllPermissionInRole($roleId)
    {
        $listPermission        = $this->permissionRepository->getAllPermission();
        $listPermissionOfRole  = $this->permissionRoleRepository->getAllPermissionByRoleId($roleId);
        $listDataAfterRefactor = $this->refactorPermissionOfRole($listPermission, $listPermissionOfRole);
        return $listDataAfterRefactor;
    }

    public function savePermission($rawData, $roleId)
    {
        $this->permissionRoleRepository->deleteUserRoleByRoleId($roleId);
        unset($rawData['user']);
        $rawDataInsert = $this->refactorDataInsertPermission($rawData, (int)$roleId);
        $this->permissionRoleRepository->insertUserRoleByRawData($rawDataInsert);
    }

    public function refactorDataInsertPermission($rawData, $roleId)
    {
        $rawDataInsert = [];
        foreach ($rawData as $key => $item){
            $dataInsert = [
                'permission_id' => $key,
                'role_id'       => $roleId
            ];
            $rawDataInsert[] = $dataInsert;
        }
        return $rawDataInsert;
    }

    public function refactorPermissionOfRole($listPermission, $permissionOfRole)
    {
        $rawData = [];
        foreach ($listPermission as $permission){
            if(isset($permissionOfRole[$permission->id])){
                $permission->isAccess = true;
            }
            $rawData[$permission->permission_category_id][] = (array)$permission;
            $rawData[$permission->permission_category_id]['category_name'] = $permission->category_name;
        }
        return $rawData;
    }

    public function getRoleByRoleId($roleId)
    {
        return $this->roleRepository->getRoleById($roleId);
    }

    public function findRoleByRoleName($roleName)
    {
        return $this->roleRepository->findRoleByName($roleName);
    }

    public function insertRole($rawData)
    {
        $this->roleRepository->insertRole($rawData);
    }
    public function getListRoles(){
      return  $this->roleRepository->getListRole();
    }

    public function updateRoleByRoleId($rawData, $roleId)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $rawDataInsert = [
            'name' =>  $rawData['name'],
            'updated_at' => date("Y/m/d H:i:s"),
        ];
        $this->roleRepository->updateRoleByRoleId($rawDataInsert, $roleId);
    }

    public function getListUserOfRoleId($roleId)
    {
        return $this->roleUserRepository->getAllUserOfRoleId($roleId);
    }

}
