<?php namespace TGLD\Tasks\UseCases;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use TGLD\Tasks\Events\TaskWasPosted;
use TGLD\Tasks\Repositories\TaskRepository;
use TGLD\Tasks\Task;

class PostNewTaskCommandHandler implements CommandHandler
{

    use DispatchableTrait, EventGenerator;

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
        $task = Task::addTask($command->title, $command->file_url, $command->description, $command->assigned_from, $command->assigned_to, $command->project, $command->priority, $command->slug);

        $task = $this->task->saveTask($task);

        $task->raise(new TaskWasPosted($task));

        $this->dispatchEventsFor($task);

        return $task;
    }
}

