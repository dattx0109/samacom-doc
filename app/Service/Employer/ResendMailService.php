<?php


namespace App\Service\Employer;


use App\Mail\Mailer;
use App\Repository\CreatePassEmployer\CreatePassEmployerRepository;
use App\Repository\Employer\EmployerRepository;

class ResendMailService
{
    private $createPassEmployerRepository;
    private $employerRepository;

    public function __construct(CreatePassEmployerRepository $createPassEmployerRepository,
                                EmployerRepository $employerRepository)
    {
        $this->createPassEmployerRepository = $createPassEmployerRepository;
        $this->employerRepository = $employerRepository;
    }
    public function sendMailResetPass($rawData)
    {
        $token        = generateRandomString(8);
        $time_expired = time() + config('main.EMPLOYER_CREATE_TIME_EXPIRE');
        $employerId = $rawData['employer_id'];
        $inforEmployer = $this->employerRepository->getDetailEmployerByEmployerId($employerId);
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
        $subject = '[Samacom] Thay đổi mật khẩu nhà tuyển dụng';
        $data  = [
            'subject' => $subject,
            'email'   => $inforEmployer->email,
            'name'    => $inforEmployer->name,
            'link'    => config('main.URL_SAMACOM_EMPLOYER_DOMAIN').'/change-password?token='.$token,
        ];
        $template_mail = 'mail.create_employer';
        Mailer::sendMail($template_mail, $data);
    }
}
