<?php namespace TGLD\Http\Controllers\Tasks;

use TGLD\Http\Controllers\CommandController;
use TGLD\Tasks\Services\TaskService;

abstract Class AbstractTaskController extends CommandController
{
    protected $taskService;

    function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
}