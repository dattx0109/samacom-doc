<?php


namespace App\Repository\Employer;

use App\Repository\Employer\EmployerPackageRequestRepository;
use App\Repository\EmployerPackageCurrent\EmployerPackageCurrentRepository;
use App\Repository\Package\PackageRepository;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class EmployerRepository
{
    const TABLE_NAME = "employers";
    const ITEM_PER_PAGE = 10;

    public function listEmployPackageWithStatusOrder()
    {
        return DB::table(self::TABLE_NAME)
            ->Join(EmployerPackageRequestRepository::TABLE_NAME, self::TABLE_NAME . '.id', '=', EmployerPackageRequestRepository::TABLE_NAME . '.employer_id')
            ->Join(PackageRepository::TABLE_NAME, EmployerPackageRequestRepository::TABLE_NAME . '.package_id', '=', PackageRepository::TABLE_NAME . '.id')
            ->select(
                self::TABLE_NAME . '.name',
                self::TABLE_NAME . '.phone',
                PackageRepository::TABLE_NAME . '.name as package_name',
                EmployerPackageRequestRepository::TABLE_NAME . '.count',
                EmployerPackageRequestRepository::TABLE_NAME . '.id',
                EmployerPackageRequestRepository::TABLE_NAME . '.status'
            )
            ->whereIn(EmployerPackageRequestRepository::TABLE_NAME . '.status', [1, 2, 3, 4])
            ->orderBy(EmployerPackageRequestRepository::TABLE_NAME . '.status', 'ASC')
            ->paginate(10);

    }

    public function approvedPackage($dataRequest, $id)
    {
        return DB::table(EmployerPackageRequestRepository::TABLE_NAME)
            ->where('id', $id)
            ->update(['status' => $dataRequest['status'], 'updated_at' => date("Y/m/d H:i:s")]);
    }

    public function listEmployPackageWithStatusPendingApprove()
    {
        return DB::table(self::TABLE_NAME)
            ->Join(EmployerPackageRequestRepository::TABLE_NAME, self::TABLE_NAME . '.id', '=', EmployerPackageRequestRepository::TABLE_NAME . '.employer_id')
            ->Join(PackageRepository::TABLE_NAME, EmployerPackageRequestRepository::TABLE_NAME . '.package_id', '=', PackageRepository::TABLE_NAME . '.id')
            ->select(
                self::TABLE_NAME . '.name',
                self::TABLE_NAME . '.phone',
                PackageRepository::TABLE_NAME . '.name as package_name',
                EmployerPackageRequestRepository::TABLE_NAME . '.count',
                EmployerPackageRequestRepository::TABLE_NAME . '.id',
                EmployerPackageRequestRepository::TABLE_NAME . '.status'
            )
            ->whereIn(EmployerPackageRequestRepository::TABLE_NAME . '.status', [4, 5, 6])
            ->orderBy(EmployerPackageRequestRepository::TABLE_NAME . '.status', 'ASC')
            ->paginate(10);
    }

    public function active($dataRequest, $id)
    {
        return DB::table(EmployerPackageRequestRepository::TABLE_NAME)
            ->where('id', $id)
            ->update(['status' => $dataRequest['status'], 'updated_at' => date("Y/m/d H:i:s")]);
    }

    public function insertEmployerPackageHistory($dataInsert)
    {
        DB::table(EmployerPackageHistoryRepository::TABLE_NAME)->insert($dataInsert);
    }

    public function listEmployer($nameOrPhone, $createdDateStart, $createdDateEnd)
    {
        $listEmployer = DB::table(self::TABLE_NAME);
        if (isset($nameOrPhone)) {
            $listEmployer->where(function ($query) use ($nameOrPhone) {
                $query->where('name', 'like', '%' . $nameOrPhone . '%')
                    ->orWhere('phone', 'like', '%' . $nameOrPhone . '%')
                    ->orWhere('email', 'like', '%' . $nameOrPhone . '%');
            });
        }
        if (isset($createdDateStart) && isset($createdDateEnd) && ($createdDateStart !== $createdDateEnd)) {
            $listEmployer->where('created_at', '>=', $createdDateStart);
            $listEmployer->where('created_at', '<=', $createdDateEnd);
        }
        if (isset($createdDateStart) && isset($createdDateEnd) && ($createdDateStart == $createdDateEnd)) {
            $listEmployer->where('created_at', '>=', $createdDateStart);
            $listEmployer->where('created_at', '<=', $createdDateEnd);
        }

        return $listEmployer->orderBy('created_at', 'desc')
            ->paginate(self::ITEM_PER_PAGE);
    }

    public function listEmployerActive()
    {
        return DB::table(EmployerPackageCurrentRepository::TABLE_NAME)
            ->join(self::TABLE_NAME, EmployerPackageCurrentRepository::TABLE_NAME . '.employer_id', '=', self::TABLE_NAME . '.id')
            ->select(
                self::TABLE_NAME . '.name',
                self::TABLE_NAME . '.phone',
                EmployerPackageCurrentRepository::TABLE_NAME . '.employer_id',
                EmployerPackageCurrentRepository::TABLE_NAME . '.view_expired_at',
                EmployerPackageCurrentRepository::TABLE_NAME . '.post_expired_at',
                EmployerPackageCurrentRepository::TABLE_NAME . '.count_view_contact_profile',
                EmployerPackageCurrentRepository::TABLE_NAME . '.count_post',
                EmployerPackageCurrentRepository::TABLE_NAME . '.count_use_view',
                EmployerPackageCurrentRepository::TABLE_NAME . '.count_use_post',
                EmployerPackageCurrentRepository::TABLE_NAME . '.updated_at'
            )
            ->orderBy(EmployerPackageCurrentRepository::TABLE_NAME . '.updated_at', 'desc')
            ->paginate(10);
    }

    public function getListAllEmployer()
    {
        return DB::table(self::TABLE_NAME)
            ->select('id', 'name', 'phone', 'email')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function buyProductByAdmin($dataBuyProduct)
    {
        return DB::table(self::TABLE_NAME)
            ->select('id', 'name', 'phone')
            ->get();
    }

    public function getDetailEmployerByEmployerId($employerId)
    {
        return DB::table(self::TABLE_NAME)
            ->where('id', $employerId)
            ->first()
            ;
    }
}
