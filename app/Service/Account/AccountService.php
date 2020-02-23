<?php
/**
 * Created by PhpStorm.
 * User: thanhvuminh
 * Date: 9/23/19
 * Time: 10:35 AM
 */

namespace App\Service\Account;

use App\Repository\Account\AccountDetailRepository;
use App\Repository\Account\AccountEducationRepository;
use App\Repository\Account\AccountExperienceRepository;
use App\Repository\Account\AccountRepository;
use App\Repository\Account\AccountSkillRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccountService
{
    private $accountRepository;
    private $accountExperienceRepository;
    private $accountSkillRepository;
    private $accountEducationRepository;

    public function __construct(
        AccountRepository $accountRepository,
        AccountExperienceRepository $accountExperienceRepository,
        AccountSkillRepository $accountSkillRepository,
        AccountEducationRepository $accountEducationRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->accountExperienceRepository = $accountExperienceRepository;
        $this->accountSkillRepository = $accountSkillRepository;
        $this->accountEducationRepository = $accountEducationRepository;
    }

    public function filterAccount($rawData)
    {
        $listPosition = isset($rawData['position_exp'])?$rawData['position_exp']: [] ;
        $listFieldWork = isset($rawData['field_exp'])?$rawData['field_exp']: [] ;
        $listSkillId = isset($rawData['skill'])? $rawData['skill']: [] ;
        $listDegree =  isset($rawData['degree_edu']) ? $rawData['degree_edu']: [];

        $listAccountByListPosition = $this->accountExperienceRepository->getListAccountByListPosition($listPosition);
        $arrayAccountIdPos = $listAccountByListPosition->pluck('account_id');
        $rawData['listAccountIdPosition'] = array_unique($arrayAccountIdPos->toArray());

        $listAccountByListField = $this->accountExperienceRepository->getListAccountByListFieldWork($listFieldWork);
        $arrayAccountIdField = $listAccountByListField->pluck('account_id');
        $rawData['listAccountIdFieldWork'] = array_unique($arrayAccountIdField->toArray());

        $listAccountByListSkill = $this->accountSkillRepository->getListAccountByListSkillId($listSkillId);
        $arrayAccountIdSkill = $listAccountByListSkill->pluck('account_id');
        $rawData['listAccountIdSkill'] = array_unique($arrayAccountIdSkill->toArray());

        $listAccountByListDegree = $this->accountEducationRepository->getListAccountByListDegree($listDegree);
        $arrayAccountIdDegree = $listAccountByListDegree->pluck('account_id');
        $rawData['listAccountIdDegree'] = array_unique($arrayAccountIdDegree->toArray());

        $listAccount = $this->accountRepository->filterAccount($rawData);
        return $listAccount;
    }
    public function backup($data)
    {
        ini_set('memory_limit', '-1');
        DB::beginTransaction();
        try {
            $dataInsertAccount = [];
            $dataInsertAccountDetail = [];
            $dataInsertAccountEdu =[];
            $dataInsertAccountExp = [];

            $listIdBackup = DB::table(AccountRepository::TABLE_NAME)
                ->where('account_type', AccountRepository::ACCOUNT_BACKUP)
                ->whereNotNull('fist_login_account_backup')
                ->pluck('id')->toArray();
            foreach ($data->listAccount as $item) {
                if (in_array($item->id, $listIdBackup)) {
                    continue;
                }
                //todo insert account
                array_push(
                    $dataInsertAccount,
                    ['id' => $item->id,
                    'name' => $item->name,
                    'phone' => $item->phone,
                    'password' => $item->password,
                    'email' => $item->email,
                    'is_active' => 1,
                    'account_type' => AccountRepository::STATUS_ACTIVE,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at]
                );

                //todo insert account detail
                array_push(
                    $dataInsertAccountDetail,
                    ['account_id' => $item->id,
                    'avatar' => $item->avatar ==null?null: env('APP_SAMACOM'). $item->avatar,
                    'image_type' => AccountDetailRepository::IMAGE_TYPE_SMC_OLD,
                    'gender' => ($item->gender_id==1||$item->gender_id==2)?$item->gender_id==1?2:1:null,
                    'date_of_birth' => $item->birthday,
                    'province_id' => $item->city_id,
                    'district_id' => $item->district_id,
                    'full_address' => $item->address,
                    'link_fb' => $item->facebook,
                    'career_goals' => nl2br($item->description) ,
                    'marital_status' => $item->marriage_id,
                    'extracurricular_activities' => $item->extracurricular_activities,
                    'strengths_weaknesses' => $item->strengths_weaknesses,
                    'height' => $item->height,
                    'job_search_status' => $item->looking_for_work,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                    ]
                );
            }
            foreach ($data->listEducation as $item) {
                if (in_array($item->user_id, $listIdBackup)) {
                    continue;
                }
                array_push(
                    $dataInsertAccountEdu,
                    ['account_id' => $item->user_id,
                    'school' => $item->university,
                    'filed_study' => $item->major,
                    'degree' => $this->mapDegree($item->education_id),
                    'description' =>nl2br($item->achievement),
                    'start_time' => null,
                    'end_time' => null,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at]
                );
            }
            foreach ($data->accountExperienceRepository as $item) {
                if (in_array($item->user_id, $listIdBackup)) {
                    continue;
                }
                array_push(
                    $dataInsertAccountExp,
                    ['account_id' => $item->user_id,
                    'start_time' => $item->date_start,
                    'end_time' => $item->date_end,
                    'position' => 1,
                    'company' => $item->company,
                    'field_work' => $this->mapFieldWork($item->career),
                    'description' => $item->description,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at]
                );
            }

            DB::table(AccountRepository::TABLE_NAME)
                ->where('account_type', AccountRepository::ACCOUNT_BACKUP)
                ->whereNull('fist_login_account_backup')
                ->delete();
            DB::table(AccountDetailRepository::TABLE_NAME)
                ->whereNotIn('account_id', $listIdBackup)
                ->whereIn('account_id', $data->account_id)
                ->delete();
            DB::table(AccountEducationRepository::TABLE_NAME)
                ->whereIn('account_id', $data->account_id)
                ->delete();
            DB::table(AccountExperienceRepository::TABLE_NAME)
                ->whereIn('account_id', $data->account_id)
                ->delete();

            $chunks = array_chunk($dataInsertAccount, 100);

            foreach ($chunks as $chunk) {
                DB::table(AccountRepository::TABLE_NAME)->insert($chunk);
            }
            $chunksDetail = array_chunk($dataInsertAccountDetail, 100);

            foreach ($chunksDetail as $chunk) {
                DB::table(AccountDetailRepository::TABLE_NAME)->insert($chunk);
            }
            $chunksEdu = array_chunk($dataInsertAccountEdu, 100);

            foreach ($chunksEdu as $chunk) {
                DB::table(AccountEducationRepository::TABLE_NAME)->insert($chunk);
            }
            $chunksExp = array_chunk($dataInsertAccountExp, 100);

            foreach ($chunksExp as $chunk) {
                DB::table(AccountExperienceRepository::TABLE_NAME)->insert($chunk);
            }

            DB::commit();
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::warning($e);
        }
    }
    private function mapDegree($education_id)
    {
        switch ($education_id) {
            case 1:
                return 4;
                break;
            case 2:
                return 3;
                break;
            case 3:
                return 2;
                break;
            case 4:
                return 1;
                break;
            case 5:
                return 6;
                break;
        }
    }
    private function mapFieldWork($fieldWork)
    {
        switch ($fieldWork) {
            case 'Khách sạn/Nhà hàng':
            case 'Du lịch/ Khách sạn':
                return 1;
                break;
            case 'Kinh doanh':
            case 'Bán lẻ/ bán sỉ':
                return 2;
                break;
            case 'Bảo hiểm':
                return 3;
                break;
            case 'Bất động sản':
                return 4;
                break;
            case 'Mỹ thuật/ Thiết kế':
            case 'Hoạch định/ Dự án':
            case 'Thiết kế đồ hoạ':
            case 'Kiến trúc/ Nội thất':
                return 5;
                break;
            case 'Phần mềm':
            case 'An toàn an ninh':
                return 6;
                break;
            case 'Công nghệ thông tin':
            case 'IT phần cứng':
                return 7;
                break;
            case 'Dầu khí/Hóa chất':
                return 8;
                break;
            case 'Dệt may/ Da giày':
            case 'Thời trang':
                return 9;
                break;
            case 'Dịch vụ khách hàng':
            case 'Luật/ Pháp lý':
            case 'Pháp chế':
                return 10;
                break;
            case 'Chứng khoán/ vàng/ tiền tệ':
            case 'Đầu tư & Thương mại':
            case 'Tài chính':
                return 11;
                break;
            case 'Răng hàm mặt':
            case 'Y tế/ Dược/ Chăm sóc sức khỏe':
                return 12;
                break;
            case 'Giáo dục/Đào tạo':
            case 'Giữ trẻ':
            case 'Tin học văn phòng':
                return 13;
                break;
            case 'Thực phẩm/Đồ uống':
            case 'Hàng tiêu dùng':
            case 'Hàng gia dụng':
                return 14;
                break;
            case 'Thương mại điện tử':
                return 15;
                break;
            case 'Điện/Điện tử/Điện lạnh':
            case 'Bảo trì/ Sửa chữa':
            case 'Cơ khí/ Chế tạo/ Tự động hoá':
                return 16;
                break;
            case 'Ngân hàng':
                return 17;
                break;
            case 'Nông/Lâm/Ngư nghiệp':
                return 18;
                break;
            case 'Ô tô/ Xe máy':
                return 19;
                break;
            case 'Digital/ Account Executive':
            case 'Marketing/ Quảng cáo':
            case 'Truyền thông':
            case 'Truyền thông tiếp thị':
                return 20;
                break;
            case 'Viễn thông':
                return 21;
                break;
            case 'Vận tải':
            case 'Hàng không':
            case 'Hàng hải':
            case 'Xuất nhập khẩu':
            case 'Bưu chính':
                return 22;
                break;
            case 'Thu mua/ Vật tư':
            case 'Xây dựng':
                return 23;
                break;
            default:
                return 24;
        }
    }


    /**
     * @param $email
     * @return int
     */
    public function logFistLoginAccountBackup($email)
    {
        return  $this->accountRepository->logFistLoginAccountBackup($email);
    }
    public function showAccount($id)
    {
        $this->accountRepository->showAccount($id);
    }
    public function hideAccount($id)
    {
        $this->accountRepository->hideAccount($id);
    }
}
