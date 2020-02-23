<?php


namespace App\Http\Controllers\RecruitmentEmployee;


use App\Http\Controllers\Controller;
use App\Mail\Mailer;
use App\Repository\RecruitmentEmployee\RecruitmentEmployeeRepository;
use App\Http\Requests\RecruitmentEmployee\RecruitmentEmployeeRequests;
use App\Repository\Referral\ReferralCreatePasswordRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
class RecruitmentEmployeeController extends Controller
{

    private $recruitmentEmployeeRepository;
    private $recruitmentEmployeeCreatePasswordRepository;

    public function __construct(
        RecruitmentEmployeeRepository    $recruitmentEmployeeRepository,
        ReferralCreatePasswordRepository $recruitmentEmployeeCreatePasswordRepository
    )
    {
        $this->recruitmentEmployeeRepository               = $recruitmentEmployeeRepository;
        $this->recruitmentEmployeeCreatePasswordRepository = $recruitmentEmployeeCreatePasswordRepository;
    }

    public function index()
    {
        return view('recruitmentEmployee.add-recruitment-employee');
    }

    public function creatRecruitmentEmployeeRepository(RecruitmentEmployeeRequests $request)
    {
        $rawData = $request->all();

        DB::beginTransaction();
        try {
            // create referral user
            $referral_uid = $this->recruitmentEmployeeRepository->create($rawData);
            // create token and send mail create password
            $token        = generateRandomString(8);
            $this->createTokenAfterRegisterReferralUser($referral_uid, $token);
            // send mail create password
            $this->sendMailCreateRecruitmentEmployee($rawData, $token);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            $errors = new MessageBag(['error' => 'Đăng ký không thành công']);
            return back()->withErrors($errors);
        }

        $errors = new MessageBag(['success' => 'Đăng ký thành công']);
        return redirect('/report-referral')->withErrors($errors);
    }

    public function createTokenAfterRegisterReferralUser($referral_uid, $token)
    {
        $time_expired = time() + config('main.EMPLOYER_CREATE_TIME_EXPIRE');
        $rawDataInsertToken = [
            'referral_user_id' => $referral_uid,
            'token'            => $token,
            'time_expired'     => $time_expired,
            'status'           => config('main.EMPLOYER_CREATE_NEW'),
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s')
        ];
        $this->recruitmentEmployeeCreatePasswordRepository->createTokenAfterRegisterReferralUser($rawDataInsertToken);
    }

    public function sendMailCreateRecruitmentEmployee($dataRecruitment, $token)
    {
        // send mail change password
        $subject = 'SAMACOM - Tạo nhân sự tuyển dụng thành công';
        $data  = [
            'subject' => $subject,
            'email'   => $dataRecruitment['email'],
            'name'    => $dataRecruitment['name'],
            'link'    => config('main.URL_SAMACOM_REFERRAL_DOMAIN').'/change-password?token='.$token,
        ];
        $template_mail = 'mail.create_employer';
        Mailer::sendMail($template_mail, $data);
    }
}
