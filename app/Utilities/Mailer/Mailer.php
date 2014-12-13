<?php namespace TGLD\Utilities\Mailer;

use Illuminate\Support\Facades\Mail;

abstract class Mailer
{
    /**
     * Abstract send mail function
     *
     * @param $email
     * @param $subject
     * @param $view
     * @param array $data
     */
    public function sendTo($email, $subject, $view, $data = [])
    {
        Mail::send($view, $data, function($message) use($email, $subject)
        {
            $message->to($email)
                ->subject($subject);
        });
    }
}