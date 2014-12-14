<?php namespace TGLD\Tasks\UseCases;

use Laracasts\Commander\CommandHandler;
use TGLD\Tasks\Repositories\TaskRepository;
use TGLD\Tasks\Task;

class DeleteTaskCommandHandler implements CommandHandler
{
    protected $taskRepo;

    function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $task = Task::deleteTask($command->task_id);

        $this->taskRepo->deleteTask($task);
    }
}