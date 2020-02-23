<?php


namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivePackageEmployerRequest;
use App\Http\Requests\ApproveRequestPackageRequest;
use App\Http\Requests\BuyProductByAdminRequest;
use App\Service\AuthorizationService\AuthorizationService;
use App\Service\AuthorizationService\PermissionConstant;
use App\Service\Employer\EmployerService;
use App\Service\Mail\MailService;
use App\Service\Package\PackageService;

class EmployerController extends Controller
{
    private $employerService;
    private $packageService;
    private $authorizationService;
    private $mailService;

    public function __construct(
        EmployerService $employerService,
        PackageService $packageService,
        AuthorizationService $authorizationService,
        MailService $mailService
    ) {
        $this->employerService = $employerService;
        $this->packageService = $packageService;
        $this->authorizationService = $authorizationService;
        $this->mailService = $mailService;
    }

    public function listEmployPackageWithStatusOrder()
    {
        $listEmployPackage = $this->employerService->listEmployPackageWithStatusOrder();
        return view('employer.list-employer-package', ['listEmployPackage' => $listEmployPackage]);
    }

    public function approvedBuyPackage(ApproveRequestPackageRequest $request, $id)
    {
        $this->employerService->approvedPackage($request->all(), $id);
    }

    public function listEmployPackageWithStatusPendingApprove()
    {
        $listEmployPackagePendingApprove = $this->employerService->listEmployPackageWithStatusPendingApprove();
        return  view('employer.list-employer-package-active', ['listEmployPackagePendingApprove' => $listEmployPackagePendingApprove]);
    }
    public function activeEmployPackage(ActivePackageEmployerRequest $request, $id)
    {
        $this->employerService->active($request->all(), $id);
    }

    public function listEmployer()
    {
        $rawData = request()->input();
        $listEmployer = $this->employerService->listEmployer($rawData);
        return view('employer.listEmployer', ['listEmployer' => $listEmployer]);
    }

    public function listEmployerBuyPackage()
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_ADMIN_LIST_EMPLOYER_USE_PACKAGE)
            ->checkPermission()
        ;
//        if (!$isAccess) {
//            return view('error.403');
//        }
        $listEmployer = $this->employerService->getListAllEmployer();
        $listPackage = $this->packageService->getList();
        $listEmployerActive = $this->employerService->listEmployerActive();
        return view('employer.listEmployerActivePackage', [
            'listEmployerActive'=>$listEmployerActive,
            'listEmployers'=>$listEmployer,
            'listPackages'=>$listPackage,
        ]);
    }
    public function buyProductByAdmin(BuyProductByAdminRequest  $request)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_ADMIN_EMPLOYER_ADD_PACKAGE)
            ->checkPermission()
        ;
        if (!$isAccess) {
            return view('error.403');
        }
        $this->employerService->buyProductByAdmin($request->all());
        $employer = $this->employerService->getDetailEmployerByEmployerId($request->employer_id);
        $this->mailService->sendMailBuyService($employer);
    }
}
