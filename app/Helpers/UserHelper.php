<?php namespace TGLD\Helpers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\URL;
use TGLD\Members\Repositories\MemberRepository;

class UserHelper
{
    protected $auth;

    protected $memberRepo;

    protected $router;

    function __construct(Guard $auth, MemberRepository $memberRepo, Router $router)
    {
        $this->auth = $auth;
        $this->memberRepo = $memberRepo;
        $this->router = $router;
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
            if($member->username != $this->router->input('username')){
                echo "<li><a href='".URL::route('assigned.tasks', $attributes = ['username' => $member->username])."'>".$member->username."</a></li>";
            }
        }
    }
} 