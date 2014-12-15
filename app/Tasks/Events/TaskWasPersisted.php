<?php namespace TGLD\Tasks\Events;

use TGLD\Tasks\Task;

class TaskWasPersisted
{
    public $task;

    function __construct(Task $task)
    {
        $this->task = $task;
    }
}