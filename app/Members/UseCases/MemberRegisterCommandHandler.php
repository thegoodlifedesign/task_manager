<?php namespace TGLD\Members\UseCases;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use TGLD\Members\Member;
use TGLD\Members\Repositories\MemberRepository;

class MemberRegisterCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var MemberRepository
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
        $member = Member::register($command->first_name, $command->last_name, $command->email, $command->username, $command->password, $command->slug);

        $this->memberRepo->save($member);

        $this->dispatchEventsFor($member);
    }
}