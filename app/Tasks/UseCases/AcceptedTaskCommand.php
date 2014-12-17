<?php namespace TGLD\Tasks\UseCases;


class AcceptedTaskCommand
{
    public $task_id;

    public $completion_time;

    function __construct($task_id, $completion_time)
    {
        $this->task_id = $task_id;
        $this->completion_time = $completion_time;
    }

} 