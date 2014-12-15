<?php namespace TGLD\Tasks\UseCases;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use TGLD\Tasks\Events\TaskWasPersisted;
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
        $task = Task::addTask($command->title, $command->file_url, $command->description, $command->assigned_from, $command->assigned_to, $command->project, $command->due_date, $command->slug, $command->related_link, $command->website_link);

        $persisted_task = $this->task->saveTask($task);

        $persisted_task->raise(new TaskWasPersisted($persisted_task));

        $this->dispatchEventsFor($persisted_task);

        $this->dispatchEventsFor($task);

        return $task;
    }
}

