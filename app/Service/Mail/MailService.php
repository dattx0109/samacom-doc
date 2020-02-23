<?php


namespace App\Service\Mail;

use App\Mail\Mailer;

class MailService
{
    public function sendMailPublicJob($job)
    {
        if (empty($job) || !$job->employer_email) {
            return false;
        }

        $email   = $job->employer_email;
        $name    = $job->employer_name;
        $subject = '[SAMACOM] - Thông báo đăng tin thành công';
        $data  = [
            'subject' => $subject,
            'email'   => $email,
            'name'    => $name,
            'link'    => config('main.URL_SAMACOM_ALPHA_DOMAIN').'/cong-viec/'.$job->id
        ];
        $template_mail = 'mail.public_job';
        return $this->sendMail($template_mail, $data);
    }
    public function sendMailBuyService($dataEmployer)
    {
        $email   = $dataEmployer->email;
        $name    = $dataEmployer->name;
        $subject = '[SAMACOM] - Thông báo dịch vụ được kích hoạt thành công';
        $data  = [
            'subject' => $subject,
            'email'   => $email,
            'name'    => $name,
        ];
        $template_mail = 'mail.active_service';
        return $this->sendMail($template_mail, $data);
    }
    private function sendMail($template_mail, $data)
    {
        return Mailer::sendMail($template_mail, $data);
    }
}
