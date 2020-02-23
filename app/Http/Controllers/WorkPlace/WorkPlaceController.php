<?php


namespace App\Http\Controllers\WorkPlace;

use App\Http\Requests\ListDistrictByProvinceRequest;
use App\Service\District\DistrictService;

class WorkPlaceController
{
    private $districtService;

    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    public function getListDistrictByProvince(ListDistrictByProvinceRequest $request)
    {
        $district = $this->districtService->getList($request->province_id);
        return response()->json($district, 200);
    }

}
