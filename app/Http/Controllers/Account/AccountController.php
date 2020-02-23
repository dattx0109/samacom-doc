<?php

namespace App\Http\Controllers\Account;

use App\Service\Account\AccountService;
use App\Service\Skill\SkillService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Province\ProvinceService;
use App\Service\District\DistrictService;
use App\Http\Requests\ListDistrictByProvinceRequest;

class AccountController extends Controller
{
    //
    private $accountService;
    private $provinceService;
    private $companyService;
    private $districtService;
    private $skillService;

    public function __construct(
        AccountService $accountService,
        ProvinceService $provinceService,
        DistrictService $districtService,
        SkillService $skillService
    ) {
        $this->accountService = $accountService;
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
        $this->skillService    = $skillService;
    }

    public function getListDistrictByProvince(ListDistrictByProvinceRequest $request)
    {
        $district = $this->districtService->getList($request->province_id);
        return response()->json($district, 200);
    }

    public function filterAccount()
    {
        $rawData = request()->input();
        $listSkill = $this->skillService->getList();
        $provinces = $this->provinceService->getList();
        $listDistrictByProvinceId = $this->districtService->getList(\request()->province_id);
        $filterAccount = $this->accountService->filterAccount($rawData);
        return view('account.list_account', ['filterAccount'=>$filterAccount,
                                                    'provinces'=>$provinces,
                                                    'listDistrictByProvinceId' => $listDistrictByProvinceId,
                                                    'listSkill' => $listSkill]);
    }
    public function showAccount($id)
    {
        $this->accountService->showAccount($id);
        return response('success', 200);
    }
    public function hideAccount($id)
    {
        $this->accountService->hideAccount($id);
        return response('success', 200);
    }

}
