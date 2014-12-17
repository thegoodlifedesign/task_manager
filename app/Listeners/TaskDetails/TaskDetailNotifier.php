<?php namespace TGLD\Listeners\TaskDetails;


use TGLD\Tasks\Events\TaskWasAccepted;
use TGLD\Tasks\Events\TaskWasPosted;
use TGLD\Tasks\Events\TaskWasUpdated;
use TGLD\Tasks\Repositories\TaskDetailRepository;

class TaskDetailNotifier
{
    protected $taskDetailsRepo;

    function __construct(TaskDetailRepository $taskDetailsRepo)
    {
        $this->taskDetailsRepo = $taskDetailsRepo;
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasPosted")
     * @param TaskWasPosted $event
     */
    public function taskWasPosted(TaskWasPosted $event)
    {
        $this->taskDetailsRepo->addDetail($event->task);
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasUpdated")
     * @param TaskWasUpdated $event
     */
    public function taskWasUpdated(TaskWasUpdated $event)
    {
        $this->taskDetailsRepo->updateDetail($event->task);
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasAccepted")
     * @param TaskWasAccepted $event
     */
    public function completion_time(TaskWasAccepted $event)
    {
        $this->taskDetailsRepo->addCompletionTime($event->task);
    }
}