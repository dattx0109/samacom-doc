<?php


namespace App\Service\Company;


use App\Http\Controllers\Test\TestController;
use App\Repository\Company\CompanyBenefitRepository;
use App\Repository\Company\CompanyDescriptionRepository;
use App\Repository\Company\CompanyRepository;
use App\Service\FileManagerService\FileManagerService;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    private $companyRepository;
    private $companyBenefitRepository;
    private $companyDescriptionRepository;
    private $fileManagerService;
    private $testController;

    public function __construct(
        CompanyRepository $companyRepository,
        CompanyBenefitRepository $companyBenefitRepository,
        CompanyDescriptionRepository $companyDescriptionRepository,
        FileManagerService $fileManagerService,
        TestController $testController
    )
    {
        $this->companyRepository = $companyRepository;
        $this->companyBenefitRepository = $companyBenefitRepository;
        $this->companyDescriptionRepository = $companyDescriptionRepository;
        $this->fileManagerService = $fileManagerService;
        $this->testController = $testController;
    }

    public function findDetailCompanyById($companyId)
    {
        $detailCompany = $this->companyRepository->findDetailCompanyById($companyId);
        $detailCompany = $this->refactorDataDetailCompany($detailCompany);
        return $detailCompany;
    }

    public function refactorDataDetailCompany($detailCompany)
    {
        if (!$detailCompany) {
            return $detailCompany;
        }
        $rawDataNew = (array)$detailCompany[0];
        $rawDataNew['benefit'] = [];
        foreach ($detailCompany as $item) {
            $value = [
                'name' => $item->name,
                'description' => $item->description,
                'icon' => $item->icon
            ];
            $rawDataNew['benefit'][] = $value;
        }
        return $rawDataNew;
    }

    public function updateCompany($rawData)
    {
        $rawDataUpdate = $this->buildDataUpdateCompany($rawData);
        $this->companyDescriptionRepository->updateDescription($rawDataUpdate['companyDescription'], $rawData['company_description_id']);
        $detailCompany = $this->findDetailCompanyById($rawData['company_id']);
        if ($detailCompany['logo'] && request()->file('logo')) {
            $path = $this->pushFile();
            $rawDataUpdateFile = [
                'logo' => $path,
            ];
            if ($path) {
                $this->updateLogo($rawDataUpdateFile, $rawData['company_id']);
                $rawDataUpdate['company']['logo'] = $path;
            }
        } elseif (!$detailCompany['logo'] && request()->file('logo')) {
            $path = $this->pushFile();
            $rawDataUpdate['company']['logo'] = $path;
        } elseif (!$detailCompany['logo'] && !request()->file('logo')) {
            $rawDataUpdate['company']['logo'] = null;
        }
        $this->companyRepository->updateCompany($rawDataUpdate['company'], $rawData['company_id']);
    }

    public function deleteAndUpdateBenefit($companyId)
    {
        return $this->companyBenefitRepository->deleteBenefitAfterUpdate($companyId);
    }


    public function buildDataUpdateCompany($rawData)
    {
        $rawDataCompanyDescription = [
            'about_us' => $rawData['about_us'],
            'mission' => $rawData['mission'],
            'vision' => $rawData['vision'],
            'core_value' => $rawData['core_value'],
            'other' => $rawData['other'],
        ];

        $rawDataCompany = [
            'name' => $rawData['name_company'],
            'address' => $rawData['address'],
            'company_size' => $rawData['company_size'],
            'short_name' => $rawData['short_name'],
            'sale_size' => $rawData['sale_size'],
            'workplace' => $rawData['workplace'],
            'district' => $rawData['district'],
            'email' => $rawData['email'],
            'hotline' => $rawData['hotline'],
            'website' => $rawData['website'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $rawData['idCompany'] = $rawData['company_id'];
//        $rawDataBenefit = $this->dataBenefit($rawData);
        return [
            'company' => $rawDataCompany,
            'companyDescription' => $rawDataCompanyDescription,
        ];
    }

    public function pushFile()
    {
        $userLogin = request()->user;
        $file = request()->file('logo');
        $user_id = $userLogin->id;
        $pathFileService = $this->fileManagerService
            ->setFile($file)
            ->setService(FileManagerService::SERVICE_ADAPP)
            ->setUserId($user_id)
            ->handle();
        return $pathFileService;
    }



    public function updateLogo($rawData, $companyId)
    {
        $this->companyRepository->updateLogo($rawData, $companyId);

    }

    public function insert($request)
    {
        $rawData = $request->all();
        $path = $this->pushFile();
        $rawData['file_id'] = null;
        if ($path) {
            $rawData['logo'] = $path;
        }
        DB::beginTransaction();
        try {
            //todo insert company description
            $rawData['company_description_id'] = $this->companyDescriptionRepository->insert($rawData);
            //todo insert company
            $rawData['idCompany'] = $this->companyRepository->insert($rawData);
            DB::commit();
            return;
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
        }
    }

    public function getListCompany($rawData)
    {
        return $this->companyRepository->getListCompany($rawData);
    }

    public function dataBenefit($rawData)
    {
        $countBenefit = count($rawData['name_benefit']);
        $dataBenefit = [];
        for ($i = 0; $i < $countBenefit; $i++) {
            array_push($dataBenefit, [
                'company_id' => $rawData['idCompany'],
                'name' => $rawData['name_benefit'][$i],
                'icon' => $rawData['icon'][$i],
                'description' => $rawData['description'][$i],
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s"),
            ]);
        }

        return $dataBenefit;
    }

    public function findNameCompanyByNameCompany($rawData)
    {
        return $this->companyRepository->findNameCompanyByNameCompany($rawData['name_company']);
    }

    public function getList()
    {
        return $this->companyRepository->getList();
    }

    public function deleteCompanyByCompanyId($companyId)
    {
        $CompanyDescriptionId = $this->companyRepository->findIdCompanyDescriptionByCompanyId($companyId);
        $this->companyRepository->deleteCompanyByCompanyId($companyId, $CompanyDescriptionId);
    }

    public function getListDescById()
    {
        $company = $this->companyRepository->getList();
        return $company->sortByDesc('id');
    }
}
