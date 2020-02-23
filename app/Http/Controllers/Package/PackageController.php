<?php


namespace App\Http\Controllers\Package;


use App\Service\Package\PackageService;

class PackageController
{
    private $packageService;

    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function detail($id)
    {
        return response()->json($this->packageService->detail($id), 200);

    }
}
