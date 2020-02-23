<?php
/**
 * Created by PhpStorm.
 * User: Yoona
 * Date: 3/6/2019
 * Time: 4:09 PM
 */

namespace App\Mail;


class Mailer
{
    public static function sendMail($template_mail, $data) {
        $send = \Mail::send($template_mail, ['data' => $data], function ($message) use ($data) {
            //$message->from($data['from'], $data['sendName'])
            $message->subject($data['subject']);
            if (!empty($data['attach']))
                $message->attach($data['attach']);

            if (!empty($data['bcc']))
                $message->bcc($data['bcc']);

            $message->to($data['email']);
        });

        if(\Mail::failures()) {
            return false;
        }

        return true;
    }
}