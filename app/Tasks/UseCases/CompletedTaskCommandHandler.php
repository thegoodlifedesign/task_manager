<?php namespace TGLD\Tasks\UseCases;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use TGLD\Tasks\Repositories\TaskRepository;
use TGLD\Tasks\Task;

class CompletedTaskCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    protected $task;

    function __construct(TaskRepository $task)
    {
        $this->task = $task;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $task = Task::completeTask($command->task_id);

        $this->task->completeTask($task);

        $this->dispatchEventsFor($task);

        return true;
    }
}