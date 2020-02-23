<?php


namespace App\Service\Company;


use App\Repository\Company\CompanyDescriptionRepositoryTest;
use App\Repository\Company\CompanyRepositoryTest;

class CompanyServiceTest
{
    private $companyDescriptionRepositoryTest;
    private $companyRepositoryTest;
    public function __construct(CompanyDescriptionRepositoryTest $companyDescriptionRepositoryTest,
                                CompanyRepositoryTest $companyRepositoryTest)
    {
        $this->companyDescriptionRepositoryTest = $companyDescriptionRepositoryTest;
        $this->companyRepositoryTest = $companyRepositoryTest;
    }

    public function insertCompany($rawData)
    {
        $rawDataInsertDes = [
            'about_us' => $rawData['about_us'],
            'mission' => $rawData['mission'],
            'vision' => $rawData['vision'],
            'core_value' => $rawData['core_value'],
            'other' => $rawData['other'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $rawData['company_description_id'] = $this->companyDescriptionRepositoryTest->insertDescription($rawDataInsertDes);
        $rawData['file_id'] = null;
        $rawDataInsertCompany = [
            'name' => $rawData['name'],
            'logo' => $rawData['logo'],
            'company_description_id' => $rawData['company_description_id'],
            'address' => $rawData['address'],
            'company_size' => $rawData['company_size'],
            'short_name' => $rawData['short_name'],
            'sale_size' => $rawData['sale_size'],
            'workplace' => $rawData['workplace'],
            'district' => $rawData['district'],
            'file_id' => $rawData['file_id'],
            'email' => $rawData['email'],
            'hotline' => $rawData['hotline'],
            'website' => $rawData['website'],
            'created_at' => $rawData['created_at'],
            'updated_at' => $rawData['updated_at'],
        ];
        $this->companyRepositoryTest->insertCompany($rawDataInsertCompany);
    }
}
