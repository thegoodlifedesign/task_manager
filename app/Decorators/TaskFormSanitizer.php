<?php namespace TGLD\Decorators;

use Laracasts\Commander\CommandBus;
use TGLD\Http\Sanitizers\TaskSanitizer;

class TaskFormSanitizer implements CommandBus
{
    protected $sanitizer;

    protected $taskRepo;

    function __construct(TaskSanitizer $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    /**
     * Execute a command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        return $this->sanitizer->sanitize($command);
    }
}