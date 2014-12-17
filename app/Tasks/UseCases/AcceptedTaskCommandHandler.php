<?php namespace TGLD\Tasks\UseCases;


use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use TGLD\Tasks\Repositories\TaskRepository;
use TGLD\Tasks\Task;

class AcceptedTaskCommandHandler implements CommandHandler
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
        $task = Task::acceptTask($command->task_id, $command->completion_time);

        $this->task->acceptTask($task);

        $this->dispatchEventsFor($task);

        return $task;
    }
}