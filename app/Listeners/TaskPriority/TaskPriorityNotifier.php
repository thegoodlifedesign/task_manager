<?php namespace TGLD\Listeners\TaskPriority;


use TGLD\Support\TaskPriority\TaskPriorityGenerator;
use TGLD\Tasks\Events\TaskWasAccepted;

class TaskPriorityNotifier
{
    protected $taskPriority;

    function __construct(TaskPriorityGenerator $taskPriority)
    {
        $this->taskPriority = $taskPriority;
    }

    /**
     * @Hears("TGLD.Tasks.Events.TaskWasAccepted")
     * @param TaskWasAccepted $event
     */
    public function taskWasAccepted(TaskWasAccepted $event)
    {
        $this->taskPriority->setPriority($event->task);
    }
}