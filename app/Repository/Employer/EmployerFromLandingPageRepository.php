<?php


namespace App\Repository\Employer;


use App\Repository\GroupPackage\GroupPackageRepository;
use App\Repository\Package\PackageRepository;
use Illuminate\Support\Facades\DB;

class EmployerFromLandingPageRepository
{
    const TABLE_NAME = 'employer_landing_page';
    const ITEM_PER_PAGE = 10;

    public function getList()
    {
        return DB::table(self::TABLE_NAME)
            ->leftJoin(PackageRepository::TABLE_NAME, self::TABLE_NAME . '.package_id', '=', PackageRepository::TABLE_NAME . '.id')
            ->select(
                self::TABLE_NAME . '.*',
                PackageRepository::TABLE_NAME.'.name as package_name'
            )
//            ->whereIn(self::TABLE_NAME . '.status', [1, 2, 3, 4])
            ->orderBy(self::TABLE_NAME . '.id', 'desc')
            ->paginate(self::ITEM_PER_PAGE)
        ;
    }

    public function UpdateStatusEmployerRequest($rawData,$id)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $id)
            ->update($rawData);
    }
}
