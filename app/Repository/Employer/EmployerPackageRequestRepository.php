<?php


namespace App\Repository\Employer;


use App\Repository\Package\PackageRepository;
use Illuminate\Support\Facades\DB;

class EmployerPackageRequestRepository
{
    const TABLE_NAME = 'employer_package_request';

    public function detail($id)
    {
      return  DB::table(self::TABLE_NAME)
            ->join(PackageRepository::TABLE_NAME, self::TABLE_NAME.'.package_id', '=',
                PackageRepository::TABLE_NAME.'.id')
          ->where(self::TABLE_NAME.'.id', $id)
            ->select(self::TABLE_NAME.'.id', self::TABLE_NAME.'.employer_id',
                self::TABLE_NAME.'.package_id',self::TABLE_NAME.'.count',
                PackageRepository::TABLE_NAME.'.count_view',
                PackageRepository::TABLE_NAME.'.count_day_view',
                PackageRepository::TABLE_NAME.'.count_employment_post',
                PackageRepository::TABLE_NAME.'.count_day_employment_post')
            ->first();

    }
}
