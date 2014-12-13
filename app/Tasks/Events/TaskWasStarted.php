<?php namespace TGLD\Tasks\Events;

use TGLD\Tasks\Task;

class TaskWasStarted
{
    public $task;

    function __construct(Task $task)
    {
        $this->task = $task;
    }
} 