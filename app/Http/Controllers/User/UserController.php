<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequset;
use App\Service\AuthorizationService\AuthorizationService;
use App\Service\AuthorizationService\PermissionConstant;
use App\Service\User\CreateUserService;
use App\Service\User\DestroyUserService;
use App\Service\User\DetailUserService;
use App\Service\AuthorizationService\ResetPasswordService;
use App\Service\Role\RoleService;
use App\Service\User\UpdateUserService;
use App\Service\User\UserService;

class UserController extends Controller
{
    private $userService;
    private $createUserService;
    private $resetPasswordRepository;
    private $detailUserService;
    private $roleService;
    private $updateUserService;
    private $destroyUserService;
    private $authorizationService;

    public function __construct(
        UserService $userService,
        CreateUserService $createUserService,
        ResetPasswordService $resetPasswordRepository,
        DetailUserService $detailUserService,
        RoleService $roleService,
        UpdateUserService $updateUserService,
        DestroyUserService $destroyUserService,
        AuthorizationService $authorizationService
    ) {
        $this->userService = $userService;
        $this->createUserService = $createUserService;
        $this->resetPasswordRepository = $resetPasswordRepository;
        $this->detailUserService = $detailUserService;
        $this->roleService = $roleService;
        $this->updateUserService = $updateUserService;
        $this->destroyUserService = $destroyUserService;
        $this->authorizationService = $authorizationService;
    }
    public function create(){

        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::USER_SYS_DETAIL_ADD)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }

        return view('user.add-user');
    }

    public function store(CreateUserRequest $request)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::USER_SYS_DETAIL_ADD)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }

        $this->createUserService->create($request->all());

        return redirect()->route('user-create');
    }

    public function show($id)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::USER_SYS_DETAIL_VIEW)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }
        $user =  $this->detailUserService->getDetail($id);
        $roles = $this->roleService->getListRoles();
        return view('user.detail-user',['user'=>$user,'roles'=>$roles]);
    }
    public function update(UpdateUserRequset $requset,$id)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::USER_SYS_DETAIL_UPDATE)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }

       return $this->updateUserService->update($requset->all(),$id);
    }
    public function destroy($id)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::USER_SYS_DETAIL_DELETE)
            ->checkPermission()
        ;

        if(!$isAccess){
            return response()->json(['error' => 'Not authorized.'],403);
        }
        $this->destroyUserService->delete($id);
    }

    public function changePassword($id)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::USER_RESET_PASS)
            ->checkPermission()
        ;

        if(!$isAccess){
            return response()->json(['error' => 'Not authorized.'],403);
        }
        $this->resetPasswordRepository->reset($id);
    }

    public function getAllUser()
    {
        $userLogin = request()->user;
        $rawData = request()->input();
//        dd($rawData);
        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::USER_SYS_LIST_VIEW)
            ->checkPermission()
        ;

        if(!$isAccess){
            return view('error.403');
        }
        $allUser = $this->userService->getAllUser($rawData);
        $listRole = $this->roleService->getAllRole();
        return view('user.list-user',['listUser' => $allUser, 'listRole' => $listRole]);
    }
}
