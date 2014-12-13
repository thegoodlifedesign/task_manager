<?php namespace TGLD\Helpers;

use Illuminate\Contracts\Auth\Guard;
use TGLD\Tasks\Repositories\TaskStatisticRepository;

class TaskHelper
{
    protected $auth;

    protected $taskStatRepo;

    function __construct(TaskStatisticRepository $taskStatRepo, Guard $auth)
    {
        $this->auth = $auth;
        $this->taskStatRepo = $taskStatRepo;
    }


    /**
     * Check if task has been accepted
     *
     * @param $task
     * @return bool
     */
    public function isTaskAccepted($task)
    {
        if($task->accepted_at != '0000-00-00 00:00:00') return true;

        return false;
    }

    /**
     * Check if task has been started
     *
     * @param $task
     * @return bool
     */
    public function isTaskStarted($task)
    {
        if($task->started_at != '0000-00-00 00:00:00') return true;

        return false;
    }

    /**
     * Check if task has been completed
     *
     * @param $task
     * @return bool
     */
    public function isTaskCompleted($task)
    {
        if($task->completed_at != '0000-00-00 00:00:00') return true;

        return false;
    }

    /**
     * Check if task has a file
     *
     * @param $task
     * @return bool
     */
    public function TaskHasFile($task)
    {
        if($task->file_url != '') return true;

        return false;
    }

    /**
     * check if the user was assigned
     * but hasnt yet accepted the task
     *
     * @param $task
     * @return bool
     */
    public function userAssignedTask($task)
    {
        $tasks = $this->taskStatRepo->getAssignedTask($task, $this->auth->user()->id);

        if($tasks and !$this->isAccepted($tasks)) return true;

        return false;
    }

    /**
     * Check if the user has accepted the task
     * but also has not started the task
     *
     * @param $task
     * @return bool
     */
    public function userAcceptedTask($task)
    {
        $tasks = $this->taskStatRepo->getAcceptedTask($task->id, $this->auth->user()->id);

        if($tasks and !$this->isStarted($tasks)) return true;

        return false;
    }

    /**
     * Check if user has started but not yet
     * completed the task
     *
     * @param $task
     * @return bool
     */
    public function userStartedTask($task)
    {
        $tasks = $this->taskStatRepo->getStartedTask($task->id, $this->auth->user()->id);

        if($tasks and !$this->isCompleted($tasks)) return true;

        return false;
    }

    /**
     * Check if user has accepted the task
     *
     * @param $task
     * @return bool
     */
    public function isAccepted($task)
    {
        if($task->accepted_by == $this->auth->user()->id) return true;

        return false;
    }

    /**
     * Check if the user has started the task
     *
     * @param $task
     * @return bool
     */
    public function isStarted($task)
    {
        if($task->started_by == $this->auth->user()->id) return true;

        return false;
    }

    /**
     * Check if user has completed the task
     *
     * @param $task
     * @return bool
     */
    public function isCompleted($task)
    {
        if($task->completed_by == $this->auth->user()->id) return true;

        return false;
    }
} 