<?php namespace TGLD\Listeners\TaskStatistics;

use TGLD\Tasks\Events\TaskWasPersisted;
use TGLD\Tasks\Events\TaskWasUpdated;
use TGLD\Tasks\Repositories\TaskStatisticRepository;
use TGLD\Tasks\Events\TaskWasAccepted;
use TGLD\Tasks\Events\TaskWasCompleted;
use TGLD\Tasks\Events\TaskWasStarted;

class TaskStatisticNotifier
{
    protected $taskStatRepo;

    function __construct(TaskStatisticRepository $taskStatRepo)
    {
        $this->taskStatRepo = $taskStatRepo;
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasPersisted")
     * @param TaskWasPersisted $event
     */
    public function taskWasPosted(TaskWasPersisted $event)
    {
        $this->taskStatRepo->addTask($event->task);
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasUpdated")
     * @param TaskWasUpdated $event
     */
    public function taskWasUpdated(TaskWasUpdated $event)
    {
        $this->taskStatRepo->updateTask($event->task);
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