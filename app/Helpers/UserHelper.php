<?php namespace TGLD\Helpers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\URL;
use TGLD\Members\Repositories\MemberRepository;

class UserHelper
{
    protected $auth;

    protected $memberRepo;

    function __construct(Guard $auth, MemberRepository $memberRepo)
    {
        $this->auth = $auth;
        $this->memberRepo = $memberRepo;
    }

    public function isUserOwner()
    {

    }

    /**
     * Check if user is the
     * one who created the task
     *
     * @param $task
     * @return bool
     */
    public function isUserTaskOwner($task)
    {
        if($this->auth->user()->username == $task->assignee->username) return true;

        return false;
    }

    public function getUserDropdown()
    {
        $members = $this->memberRepo->getAll();

        foreach($members as $member)
        {
            if($member->username != $this->auth->user()->username){
                echo "<li><a href='".URL::route('assigned.tasks', $attributes = ['username' => $member->username])."'>".$member->username."</a></li>";
            }
        }
    }
} 