<?php


namespace App\Repository\Company;


use Illuminate\Support\Facades\DB;

class CompanyRepository

{
    const TABLE_NAME    = 'companies';
    const ITEM_OF_PAGE  = 10;

    public function insert($rawData)
    {
        return DB::table(self::TABLE_NAME)
            ->insertGetId([
                'name'                      => $rawData['name_company'],
                'logo'                      => $rawData['logo'],
                'company_description_id'    => $rawData['company_description_id'],
                'address'                   => $rawData['address'],
                'company_size'              => $rawData['company_size'],
                'short_name'                => $rawData['short_name'],
                'sale_size'                 => $rawData['sale_size'],
                'workplace'                 => $rawData['workplace'],
                'district'                  => $rawData['district'],
                'email'                     => $rawData['email'],
                'hotline'                   => $rawData['hotline'],
                'website'                   => $rawData['website'],
                'file_id'                   => $rawData['file_id'],
                'created_at'                => date("Y/m/d H:i:s"),
                'updated_at'                => date("Y/m/d H:i:s"),
            ]);
    }

    public function getListCompany($rawData)
    {
        $listCompany = DB::table(self::TABLE_NAME)
            ->where('deleted_at', '=', null);
        if (isset($rawData)){
            $listCompany->where('name','like','%'. $rawData.'%');
        }
        return $listCompany
            ->orderBy('created_at','desc')
            ->paginate(self::ITEM_OF_PAGE);
    }

    public function findNameCompanyByNameCompany($nameCompany)
    {
        return DB::table(self::TABLE_NAME)
            ->where('name', $nameCompany)
            ->count()
        ;
    }

    public function findDetailCompanyById($companyId)
    {
        return DB::table(self::TABLE_NAME)
            ->leftJoin(CompanyDescriptionRepository::TABLE_NAME, self::TABLE_NAME.'.company_description_id','=',CompanyDescriptionRepository::TABLE_NAME.'.id')
            ->leftJoin(CompanyBenefitRepository::TABLE_NAME,self::TABLE_NAME.'.id','=',CompanyBenefitRepository::TABLE_NAME.'.company_id')
            ->where(self::TABLE_NAME.'.id',$companyId)
            ->select(self::TABLE_NAME.'.*',self::TABLE_NAME.'.id as id_company',self::TABLE_NAME.'.id as company_id',CompanyDescriptionRepository::TABLE_NAME.'.*',CompanyBenefitRepository::TABLE_NAME.'.*',self::TABLE_NAME.'.name as name_company',CompanyBenefitRepository::TABLE_NAME.'.name as benefit_name')
            ->get()
        ;
    }

    public function updateCompany($rawData, $companyId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $companyId)
            ->update($rawData);
    }
    public function getList()
    {
       return DB::table(self::TABLE_NAME)->get();
    }

    public function findIdCompanyDescriptionByCompanyId($companyId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $companyId)
            ->value('company_description_id')
        ;
    }

    public function deleteCompanyByCompanyId($companyId, $CompanyDescriptionId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $companyId)
            ->update([
                    'deleted_at' => date("Y/m/d H:i:s"),
                    'company_description_id' => $CompanyDescriptionId,
            ])
        ;
    }

    public function updateLogo($rawData, $companyId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id',$companyId)
            ->update($rawData)
            ;
    }
}
