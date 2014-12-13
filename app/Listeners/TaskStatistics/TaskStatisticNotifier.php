<?php namespace TGLD\Listeners\TaskStatistics;

use Laracasts\Commander\Events\EventListener;
use TGLD\Tasks\Repositories\TaskStatisticRepository;
use TGLD\Tasks\Events\TaskWasAccepted;
use TGLD\Tasks\Events\TaskWasCompleted;
use TGLD\Tasks\Events\TaskWasPosted;
use TGLD\Tasks\Events\TaskWasStarted;

class TaskStatisticNotifier extends EventListener
{
    protected $taskStatRepo;

    function __construct(TaskStatisticRepository $taskStatRepo)
    {
        $this->taskStatRepo = $taskStatRepo;
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasPosted")
     * @param TaskWasPosted $event
     */
    public function taskWasPosted(TaskWasPosted $event)
    {
        $this->taskStatRepo->addTask($event->task);
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasAccepted")
     * @param TaskWasAccepted $event
     */
    public function taskWasAccepted(TaskWasAccepted $event)
    {
        $this->taskStatRepo->acceptTask($event->task->id);
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasStarted")
     * @param TaskWasStarted $event
     */
    public function taskWasStarted(TaskWasStarted $event)
    {
        $this->taskStatRepo->startTask($event->task->id);
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasCompleted")
     * @param TaskWasCompleted $event
     */
    public function taskWasCompleted(TaskWasCompleted $event)
    {
        $this->taskStatRepo->completeTask($event->task->id);
    }
} 