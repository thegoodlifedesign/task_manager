<?php namespace TGLD\Http\Controllers\Projects;

use TGLD\Http\Controllers\CommandController;
use TGLD\Tasks\Services\TaskService;

class AbstractProjectController extends CommandController
{
    protected $taskService;

    function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
}