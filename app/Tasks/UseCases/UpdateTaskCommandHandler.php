<?php namespace TGLD\Tasks\UseCases;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use TGLD\Tasks\Repositories\TaskRepository;
use TGLD\Tasks\Task;

class UpdateTaskCommandHandler implements CommandHandler
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
        $task = Task::updateTask($command->title, $command->description, $command->assigned_from, $command->assigned_to, $command->project, $command->priority, $command->id, $command->slug);

        $this->task->updateTask($task);

        $this->dispatchEventsFor($task);

        return $task;
    }
}