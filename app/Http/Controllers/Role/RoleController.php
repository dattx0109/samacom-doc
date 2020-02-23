<?php


namespace App\Http\Controllers\Role;


use App\Http\Controllers\Controller;
use App\Http\Requests\CheckUserPermissionRequest;
use App\Http\Requests\EditRoleRequest;
use App\Service\Role\RoleService;
use App\Service\AuthorizationService\AuthorizationService;
use App\Service\AuthorizationService\PermissionConstant;

class RoleController extends Controller
{
    private $roleService;
    private $authorizationService;

    public function __construct(RoleService $roleService, AuthorizationService $authorizationService)
    {
        $this->roleService          = $roleService;
        $this->authorizationService = $authorizationService;
    }

    public function getListRole()
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_SYS_LIST_VIEW)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }
        $listRole = $this->roleService->getListRole();
        return view('role.role',[
            'listRole' => $listRole
        ]);
    }

    public function deleteRoleByRoleId($roleId)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_SYS_DELETE)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }

        $this->roleService->deleteRolebyRoleId($roleId);
        return Redirect('role')->with('delete', 'Xoá vai trò thành công');
    }

    public function getDetailRole($roleId)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_SYS_PERMISSION_CONTROL)
            ->checkPermission()
        ;

        if( ! $isAccess){
            return view('error.403');
        }

        $role = $this->roleService->getRoleByRoleId($roleId);
        $rawData = $this->roleService->getAllPermissionInRole($roleId);
//        dd($rawData);
        return view('role.role-detail', [
            'permission' => $rawData,
            'role'       => $role
        ]);
    }

    public function savePermission($roleId)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_SYS_PERMISSION_CONTROL)
            ->checkPermission()
        ;

        if( ! $isAccess){
            return view('error.403');
        }

        $rawData = request()->input();
//        dd($rawData);
        $this->roleService->savePermission($rawData, $roleId);
        return redirect('/role/'.$roleId)->with('message', 'Update permission thành công');
    }

    public function addNewRole()
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_SYS_ADD)
            ->checkPermission()
        ;

        if(!$isAccess){
            return response()->json([
                'message'   => 'Bạn không có quyền thêm vai trò',
                'code'      => 4
            ],200);
        }

//      $userId = request()->user->id;
        $rawData = request()->input();
        if(!isset($rawData['roleName'])){
            return response()->json([
                'message'   => 'Tên vai trò không đươc để trống',
                'code'      => 1
            ],200);
        }

        $isRoleNameExit = $this->roleService->findRoleByRoleName($rawData['roleName']);

        if($isRoleNameExit){
            return response()->json([
                'message'   => 'Vai trò bạn nhập đã tồn tại',
                'code'      => 2
            ],200);
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $rawDataInsert = [
            'name' => $rawData['roleName'],
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s"),
        ];

        $this->roleService->insertRole($rawDataInsert);
        return response()->json([
           'message'    => 'Thêm mới vai trò thành công',
            'code'      => 3
        ]);

    }

    public function showRole($roleId)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_SYS_LIST_VIEW)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }

        $roleDetail  = $this->roleService->getRoleByRoleId($roleId);
        return view('role.role-update',[
           'role'    =>  $roleDetail,
        ]);
    }

    public function updateRoleByRoleId(EditRoleRequest $request, $roleId)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_SYS_NAME_EDIT)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }
        $this->roleService->updateRoleByRoleId($request->all(),$roleId);
        return redirect('/role');
    }

    public function checkUserPermissions(CheckUserPermissionRequest $request)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName($request->permission)
            ->checkPermission();
        if (!$isAccess) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }
        return response()->json(['success' => 'authorized.'], 200);
    }

    public function getListUserOfRole()
    {
        $roleId = request()->input('role_id');
        $listUser = $this->roleService->getListUserOfRoleId($roleId);

        return response()->json(['data' => $listUser]);
    }
}
