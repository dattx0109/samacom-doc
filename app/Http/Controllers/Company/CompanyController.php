<?php


namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Service\AuthorizationService\AuthorizationService;
use App\Service\AuthorizationService\PermissionConstant;
use App\Service\Company\CompanyService;
use App\Http\Requests\Company\CompanyRequest;
use App\Service\Province\ProvinceService;
use App\Service\District\DistrictService;
use Session;

class CompanyController extends Controller
{
    private $companyService;
    private $authorizationService;
    private $provinceService;
    private $districtService;

    public function __construct(
        CompanyService $companyService,
        AuthorizationService $authorizationService,
        ProvinceService $provinceService,
        DistrictService $districtService
    )
    {
        $this->companyService = $companyService;
        $this->authorizationService = $authorizationService;
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
    }

    public function index()
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_COMPANY_SYS_LIST_VIEW)
            ->checkPermission();

        if (!$isAccess) {
            return view('error.403');
        }
        $rawData = request()->input('company_name');
        $dataCompany = $this->companyService->getListCompany($rawData);
        return view('company.list-company', [
            'dataCompany' => $dataCompany,
        ]);
    }

    public function create()
    {
        $provinces = $this->provinceService->getList();
        return view('company.add-company', ['provinces'=>$provinces]);
    }

    public function store(CompanyRequest $request)
    {

        $this->companyService->insert($request);
        return;
    }

    public function checkNameCompany()
    {
        $rawData = request()->input();
        $isNameCompanyExit = $this->companyService->findNameCompanyByNameCompany($rawData);
        if ($isNameCompanyExit) {
            return response()->json([
                'message' => 'Công ty đã tồn tại',
                'code' => 1
            ], 422);
        }
    }

    public function getDetailCompany($companyId)
    {
        $detailCompany = $this->companyService->findDetailCompanyById($companyId);
        $detailCompany['logo'] = env('RICH_FILE_URL_BASE').$detailCompany['logo'];
        $provinces = $this->provinceService->getList();
        $districts = $this->districtService->getList($detailCompany['workplace']);
        return view('company.edit-company', [
            'detailCompany' => $detailCompany,
            'provinces' => $provinces,
            'districts' => $districts
        ]);
    }

    public function updateCompany(UpdateCompanyRequest $request, $companyId)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_COMPANY_SYS_DETAIL_EDIT)
            ->checkPermission();

        if (!$isAccess) {
            return view('error.403');
        }
        $this->companyService->updateCompany(request()->input());

        return;
    }

    public function delete($companyId)
    {
        $userLogin = request()->user;

        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_COMPANY_SYS_DELETE)
            ->checkPermission();

        if (!$isAccess) {
            return view('error.403');
        }
        $this->companyService->deleteCompanyByCompanyId($companyId);
        return redirect()->route('company-index');
    }

    public function detailCompany($companyId)
    {
        $userLogin = request()->user;
        $isAccess = $this->authorizationService
            ->setUserLogin($userLogin)
            ->setPermissionName(PermissionConstant::ROLE_COMPANY_SYS_DETAIL_VIEW)
            ->checkPermission();

        if (!$isAccess) {
            return view('error.403');
        }
        $detailCompany = $this->companyService->findDetailCompanyById($companyId);
        $detailCompany['logo'] = env('RICH_FILE_URL_BASE').$detailCompany['logo'];
        $provinces = $this->provinceService->getList();
        $districts = $this->districtService->getList($detailCompany['workplace']);
        return view('company.detail-company', [
            'detailCompany' => $detailCompany,
            'provinces' => $provinces,
            'districts' => $districts
        ]);
    }
}
