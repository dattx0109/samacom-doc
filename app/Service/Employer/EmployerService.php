<?php


namespace App\Service\Employer;

use App\Mail\MailEmployer;
use App\Mail\Mailer;
use App\Repository\CreatePassEmployer\CreatePassEmployerRepository;
use App\Repository\Employer\EmployerPackageRequestRepository;
use App\Repository\Package\PackageAdminAdd;
use App\Repository\Package\PackageRepository;
use Illuminate\Support\Facades\Hash;
use App\Repository\Employer\EmployerRepository;
use App\Repository\EmployerPackageCurrent\EmployerPackageCurrentRepository;
use Illuminate\Support\Facades\DB;
use App\Repository\Employer\RegisterEmployeerRepository;
use Illuminate\Support\Facades\Mail;

class EmployerService
{
    private $employerRepository;
    private $employerPackageRepository;
    private $employerRegisterRepository;
    private $packageCurrentRepository;
    private $packageRepository;
    private $packageAdminAdd;
    private $createPassEmployerRepository;
    const PACKAGE_TYPE_EMPLOYER_BUY = 1;
    const PACKAGE_TYPE_ADMIN_ADD = 2;

    public function __construct(
        EmployerRepository $employerRepository,
        EmployerPackageRequestRepository $employerPackageRepository,
        EmployerPackageCurrentRepository $packageCurrentRepository,
        RegisterEmployeerRepository $employerRegisterRepository,
        PackageRepository $packageRepository,
        PackageAdminAdd $packageAdminAdd,
        CreatePassEmployerRepository $createPassEmployerRepository
    ) {
        $this->employerRegisterRepository = $employerRegisterRepository;
        $this->employerRepository = $employerRepository;
        $this->employerPackageRepository = $employerPackageRepository;
        $this->packageCurrentRepository = $packageCurrentRepository;
        $this->packageRepository = $packageRepository;
        $this->packageAdminAdd = $packageAdminAdd;
        $this->createPassEmployerRepository = $createPassEmployerRepository;
    }

    public function listEmployPackageWithStatusOrder()
    {
        return $this->employerRepository->listEmployPackageWithStatusOrder();
    }

    public function approvedPackage($dataRequest, $id)
    {
        return $this->employerRepository->approvedPackage($dataRequest, $id);
    }

    public function listEmployPackageWithStatusPendingApprove()
    {
        return $this->employerRepository->listEmployPackageWithStatusPendingApprove();
    }

    public function active($dataRequest, $id)
    {
        DB::beginTransaction();
        try {
            $packageHistory = $this->employerPackageRepository->detail($id);
            $this->employerRepository->active($dataRequest, $id);
            if ($dataRequest['status'] == 6 && !empty($packageHistory)) {
                $employerPackageCurrent = $this->buildDataInsertPackageEmployerCurrent($packageHistory);
                if (array_key_exists('created_at', $employerPackageCurrent)) {
                    $this->packageCurrentRepository->insert($employerPackageCurrent);
                } else {
                    $this->packageCurrentRepository->update($employerPackageCurrent);
                }
                $dataHistory = [
                    'package_id' => $packageHistory->package_id,
                    'employer_id' => $packageHistory->employer_id,
                    'count' => $packageHistory->count,
                    'package_type' => self::PACKAGE_TYPE_EMPLOYER_BUY,
                    'admin_id' => null,
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")];
                $this->employerRepository->insertEmployerPackageHistory($dataHistory);
            }
            DB::commit();
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'insert_ errror'], 422);
        }
    }

    public function buildDataInsertPackageEmployerCurrent($packageHistory)
    {

        $dataInsert = [
            'employer_id' => $packageHistory->employer_id,
            'updated_at' => date("Y/m/d H:i:s")
        ];
        $employerPackageCurrent = $this->packageCurrentRepository->detailByEmployerId($packageHistory->employer_id);
        if (empty($employerPackageCurrent)) {
            //todo  empty data employerPackageCurrent
            if (($packageHistory->count * $packageHistory->count_day_view) > 90) {
                $dataInsert['view_expired_at'] = date('Y-m-d', strtotime("+90 days"));
            } else {
                $dataInsert['view_expired_at'] = date(
                    'Y-m-d',
                    strtotime("+" . $packageHistory->count * $packageHistory->count_day_view . "days")
                );
            }
            if (($packageHistory->count * $packageHistory->count_day_employment_post) > 90) {
                $dataInsert['post_expired_at'] = date('Y-m-d', strtotime("+90 days"));
            } else {
                $dataInsert['post_expired_at'] = date(
                    'Y-m-d',
                    strtotime("+" . $packageHistory->count * $packageHistory->count_day_employment_post . "days")
                );
            }
            $dataInsert['count_view_contact_profile'] = $packageHistory->count * $packageHistory->count_view;
            $dataInsert['count_post'] = $packageHistory->count * $packageHistory->count_employment_post;
            $dataInsert['count_use_view'] = 0;
            $dataInsert['count_use_post'] = 0;
            $dataInsert['created_at'] = date("Y/m/d H:i:s");
        } else {
            //todo  data employerPackageCurrent
            $today = date("Y-m-d");

            if (strtotime($today) > strtotime($employerPackageCurrent->view_expired_at)) {
                //todo  todo > view_expired_at
                $dataInsert['count_view_contact_profile'] = $packageHistory->count * $packageHistory->count_view;
                if (($packageHistory->count * $packageHistory->count_day_view) > 90) {
                    $dataInsert['view_expired_at'] = date('Y-m-d', strtotime("+90 days"));
                } else {
                    $dataInsert['view_expired_at'] = date(
                        'Y-m-d',
                        strtotime("+" . $packageHistory->count * $packageHistory->count_day_view . "days")
                    );
                }
                $dataInsert['count_use_view'] = 0;
            } else {
                if (strtotime(date(
                    'Y-m-d',
                    strtotime($employerPackageCurrent->view_expired_at . ' + ' . $packageHistory->count * $packageHistory->count_day_view . ' days')
                ))
                    > strtotime(date('Y-m-d', strtotime("+90 days")))) {
                    $dataInsert['view_expired_at'] = date('Y-m-d', strtotime("+90 days"));
                } else {
                    $dataInsert['view_expired_at'] = date(
                        'Y-m-d',
                        strtotime($employerPackageCurrent->view_expired_at . ' + ' . $packageHistory->count * $packageHistory->count_day_view . ' days')
                    );
                }
                $dataInsert['count_view_contact_profile'] = $employerPackageCurrent->count_view_contact_profile + $packageHistory->count * $packageHistory->count_view;
                $dataInsert['count_use_view'] = $employerPackageCurrent->count_use_view;
            }
            if (strtotime($today) > strtotime($employerPackageCurrent->post_expired_at)) {
                $dataInsert['count_post'] = $packageHistory->count * $packageHistory->count_employment_post;
                if (($packageHistory->count * $packageHistory->count_day_employment_post) > 90) {
                    $dataInsert['post_expired_at'] = date('Y-m-d', strtotime("+90 days"));
                } else {
                    $dataInsert['post_expired_at'] = date(
                        'Y-m-d',
                        strtotime("+" . $packageHistory->count * $packageHistory->count_day_employment_post . "days")
                    );
                }
                $dataInsert['count_use_post'] = 0;
            } else {
                if (strtotime(date(
                    'Y-m-d',
                    strtotime($employerPackageCurrent->post_expired_at . ' + ' . $packageHistory->count * $packageHistory->count_employment_post . ' days')
                ))
                    > strtotime(date('Y-m-d', strtotime("+90 days")))) {
                    $dataInsert['post_expired_at'] = date('Y-m-d', strtotime("+90 days"));
                } else {
                    $dataInsert['post_expired_at'] = date(
                        'Y-m-d',
                        strtotime($employerPackageCurrent->post_expired_at . ' + ' . $packageHistory->count * $packageHistory->count_employment_post . ' days')
                    );
                }
                $dataInsert['count_post'] = $employerPackageCurrent->count_post + $packageHistory->count * $packageHistory->count_employment_post;
                $dataInsert['count_use_post'] = $employerPackageCurrent->count_use_post;
            }
        }
        return $dataInsert;
    }

    public function getUserByPhone($phone)
    {
        return $this->employerRegisterRepository->getUserByPhone($phone);
    }

    public function findEmailByPhone($phone)
    {
        return $this->employerRegisterRepository->findEmailByPhone($phone);
    }

    public function findEmailAfterRegister($email)
    {
        return $this->employerRegisterRepository->findEmailAfterRegister($email);
    }

    public function findPhoneAfterRegister($phone)
    {
        return $this->employerRegisterRepository->findPhoneAfterRegister($phone);
    }

    public function register($rawData)
    {
        $rawDataInsert = [
            'name'       => $rawData['name'],
            'email'      => $rawData['email'],
            'phone'      => $rawData['phone'],
            'password'   => Hash::make(config('main.EMPLOYEE_CREATE_PASSWORD_DEFAULT')),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $employerId = $this->employerRegisterRepository->register($rawDataInsert);
        // update history create employer
        $token        = generateRandomString(8);
        $time_expired = time() + config('main.EMPLOYER_CREATE_TIME_EXPIRE');
        $rawDataInsertToken = [
            'employer_id'  => $employerId,
            'token'        => $token,
            'time_expired' => $time_expired,
            'status'       => config('main.EMPLOYER_CREATE_NEW'),
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];
        $this->createPassEmployerRepository->createTokenAfterRegisterEmployer($rawDataInsertToken);
        // send mail change password
        $subject = '[Samacom] Thông báo tài khoản đã được khởi tạo';
        $data  = [
            'subject' => $subject,
            'email'   => $rawData['email'],
            'name'    => $rawData['name'],
            'link'    => config('main.URL_SAMACOM_EMPLOYER_DOMAIN').'/change-password?token='.$token,
        ];
        $template_mail = 'mail.create_employer';
        Mailer::sendMail($template_mail, $data);
    }

    public function storeSession($user)
    {
        session()->put('user', $user);
    }

    public function changePassword($passwordNew, $id)
    {
        return $this->employerRegisterRepository->changePassword($passwordNew, $id);
    }

    public function listEmployer($rawData)
    {
        $nameOrPhone = null;
        if (isset($rawData['name_or_phone'])) {
            $nameOrPhone = $rawData['name_or_phone'];
        }
        $createdDateStart = null;
        $createdDateEnd = null;
        if (isset($rawData['date_created'])) {
            $rawDataDate = $rawData['date_created'];
            $rawDataDateRefactor = explode('-', $rawDataDate);
            $createdDateStart = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $rawDataDateRefactor[0])));
            $createdDateEnd = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $rawDataDateRefactor[1])));
            $createdDateEnd = str_replace('00:00:00', '23:59:59', $createdDateEnd);
        }
        return $this->employerRepository->listEmployer($nameOrPhone, $createdDateStart, $createdDateEnd);
    }

    public function listEmployerActive()
    {
        return $this->employerRepository->listEmployerActive();
    }

    public function getListAllEmployer()
    {
        return $this->employerRepository->getListAllEmployer();
    }

    public function buyProductByAdmin($dataBuyProduct)
    {
        if ($dataBuyProduct['package_type'] == 1) {
            $package = $this->packageRepository->detail($dataBuyProduct['package']);
            $packageHistory = new \stdClass();
            $packageHistory->employer_id = $dataBuyProduct['employer_id'];
            $packageHistory->count_view = $package->count_view;
            $packageHistory->count_day_view = $package->count_view;
            $packageHistory->count_employment_post = $package->count_employment_post;
            $packageHistory->count_day_employment_post = $package->count_day_employment_post;
            $packageHistory->count = $dataBuyProduct['count'];
            ;
            $employerPackageCurrent = $this->buildDataInsertPackageEmployerCurrent($packageHistory);
            if (array_key_exists('created_at', $employerPackageCurrent)) {
                $this->packageCurrentRepository->insert($employerPackageCurrent);
            } else {
                $this->packageCurrentRepository->update($employerPackageCurrent);
            }
            $dataHistory = [
                'package_id' => $dataBuyProduct['package'],
                'employer_id' => $dataBuyProduct['employer_id'],
                'count' => $dataBuyProduct['count'],
                'package_type' => self::PACKAGE_TYPE_EMPLOYER_BUY,
                'admin_id' => request()->user->id,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")];
            $this->employerRepository->insertEmployerPackageHistory($dataHistory);
        }
        if ($dataBuyProduct['package_type'] == 2) {
            $dataInsert = [
                'count_view' => $dataBuyProduct['count_view'],
                'count_day_view' => $dataBuyProduct['count_day_view'],
                'count_employment_post' => $dataBuyProduct['count_employment_post'],
                'count_day_employment_post' => $dataBuyProduct['count_day_employment_post'],
            ];
            $packageAdminAddId = $this->packageAdminAdd->insert($dataInsert);
            $dataHistory = [
                'package_id' => $packageAdminAddId,
                'employer_id' => $dataBuyProduct['employer_id'],
                'count' => 1,
                'package_type' => self::PACKAGE_TYPE_ADMIN_ADD,
                'admin_id' => request()->user->id,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")];
            $this->employerRepository->insertEmployerPackageHistory($dataHistory);
            $packageHistory = new \stdClass();
            $packageHistory->employer_id = $dataBuyProduct['employer_id'];
            $packageHistory->count_view = $dataBuyProduct['count_view'];
            $packageHistory->count_day_view = $dataBuyProduct['count_day_view'];
            $packageHistory->count_employment_post = $dataBuyProduct['count_employment_post'];
            $packageHistory->count_day_employment_post = $dataBuyProduct['count_day_employment_post'];
            $packageHistory->count = 1;
            ;
            $employerPackageCurrent = $this->buildDataInsertPackageEmployerCurrent($packageHistory);
            if (array_key_exists('created_at', $employerPackageCurrent)) {
                $this->packageCurrentRepository->insert($employerPackageCurrent);
            } else {
                $this->packageCurrentRepository->update($employerPackageCurrent);
            }
        }
    }

    public function listAllEmployer()
    {
        return $this->employerRepository->getListAllEmployer();
    }
    public function getDetailEmployerByEmployerId($employerId)
    {
        return $this->employerRepository->getDetailEmployerByEmployerId($employerId);
    }
}
