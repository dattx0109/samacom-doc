<?php


namespace App\Http\Controllers\Company;


use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyRequest;
use App\Service\Company\CompanyServiceTest;

class CompanyControllerTest extends Controller
{
    private $companyServiceTest;
    public function __construct(CompanyServiceTest $companyServiceTest)
    {
        $this->companyServiceTest = $companyServiceTest;
    }
    public function getCreateCompany()
    {
        return view('company.add-company-test');
    }

    public function postCreateCompany()
    {
        $rawData = request()->all();
        dd($rawData);
        $this->companyServiceTest->insertCompany($rawData);
    }
}
