<?php namespace TGLD\Listeners\Emails;

use Laracasts\Commander\Events\EventListener;
use TGLD\Members\Events\MemberWasRegistered;
use TGLD\Utilities\Mailer\RegisterMailer;

class EmailNotifier extends EventListener
{
    protected $mailer;

    function __construct(RegisterMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send welcome email to new user
     *
     * @Hears("TGLD.Members.Events.MemberWasRegistered")
     * @param MemberWasRegistered $event
     */
    public function memberWasRegistered(MemberWasRegistered $event)
    {
        $this->mailer->sendWelcome($event);
        $this->mailer->sendActivation($event);
    }
}