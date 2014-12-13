<?php namespace TGLD\Members\UseCases;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use TGLD\Members\Member;
use TGLD\Members\Repositories\MemberRepository;

class MemberActivateCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var
     */
    protected $memberRepo;

    /**
     * @param MemberRepository $memberRepo
     */
    function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $token = Member::activate($command->activate_token);

        $this->memberRepo->activate($command);

        $this->dispatchEventsFor($token);
    }
}

