<?php namespace TGLD\Tasks\UseCases;


class CompletedTaskCommand
{
    public $task_id;

    function __construct($task_id)
    {
        $this->task_id = $task_id;
    }


} 