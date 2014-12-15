<?php namespace TGLD\Tasks\UseCases;


class DenyTaskCommand
{
    public $task_id;

    function __construct($task_id)
    {
        $this->task_id = $task_id;
    }
}