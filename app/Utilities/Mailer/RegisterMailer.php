<?php namespace TGLD\Utilities\Mailer;


class RegisterMailer extends Mailer
{
    public function sendActivation($event)
    {
        $this->sendTo('rodzzlessa@gmail.com',
            'New team member!',
            'emails.auth.accept_member',
            [
                'first_name'    => $event->member->first_name,
                'last_name'     => $event->member->last_name,
                'username'      => $event->member->username,
                'email'         => $event->member->email,
            ]);
    }

    public function sendWelcome($event)
    {
        $this->sendTo($event->member->email,
            'Welcome to the team!',
            'emails.auth.register',
            [
                'first_name'    => $event->member->first_name,
                'last_name'     => $event->member->last_name,
                'username'      => $event->member->username,
                'email'         => $event->member->email,
            ]);
    }

    public function sendActivationConfirmation($event)
    {
        $this->sendto('rodzzlessa@gmail.com',
            'New team member Activated!',
            'emails.auth.activated',
            [
                'username' => $event->member->activate_token,
            ]);
    }
}