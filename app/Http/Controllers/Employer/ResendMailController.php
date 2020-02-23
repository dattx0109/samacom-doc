<?php


namespace App\Http\Controllers\Employer;


use App\Http\Controllers\Controller;
use App\Service\Employer\EmployerService;
use App\Service\Employer\ResendMailService;

class ResendMailController extends Controller
{
    private $resendMailService;
    private $employerService;

    public function __construct(ResendMailService $resendMailService,
                                EmployerService $employerService)
    {
        $this->resendMailService = $resendMailService;
        $this->employerService = $employerService;
    }
    public function getSendMailResetPass()
    {
        $listEmployer = $this->employerService->listAllEmployer();
        return view('employer.resend-mail-reset-pass',['listEmployer' => $listEmployer]);
    }

    public function postSendMailResetPass()
    {
        $rawData = request()->all();
        $listEmployer = $this->employerService->listAllEmployer();
        if (!$rawData['employer_id']){
            return view('employer.resend-mail-reset-pass',['listEmployer' => $listEmployer,
                'messageFail' => 'Bạn chưa chọn nhà tuyển dụng']);
        }
        $this->resendMailService->sendMailResetPass($rawData);
        return view('employer.resend-mail-reset-pass',['listEmployer' => $listEmployer,
                                                            'message' => 'Gửi mail thành công']);
    }
}
