<?php namespace TGLD\Helpers;


use Auth;

class UserHelper
{
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
        if(Auth::user()->username == $task->assignee->username) return true;

        return false;
    }
} 