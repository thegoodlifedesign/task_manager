<?php namespace TGLD\Support\TaskPriority;

use Carbon\Carbon;
use TGLD\Tasks\Repositories\TaskDetailRepository;
use TGLD\Tasks\Repositories\TaskRepository;

class TaskPriorityGenerator
{
    protected $carbon;

    protected $taskRepo;

    protected $taskDetailRepo;

    function __construct(Carbon $carbon, TaskRepository $taskRepo, TaskDetailRepository $taskDetailRepo)
    {
        $this->carbon = $carbon;
        $this->taskRepo = $taskRepo;
        $this->taskDetailRepo = $taskDetailRepo;
    }

    /**
     * @param $task
     */
    public function setPriority($task)
    {
        $db_task = $this->taskDetailRepo->getTaskByTaskId($task->id);

        $days_away = $this->getDate($task, $db_task);

        $this->decidePriority($task, $days_away);
    }

    public function setAllPriorities()
    {
        $tasks = $this->taskRepo->getAll();

        foreach($tasks as $task)
        {
            if( ! is_null($task->taskDetails->completion_time))
            {
                $this->setPriority($task);
            }
        }
    }

    /**
     * @param $task
     * @param $days_away
     */
    public function decidePriority($task, $days_away)
    {
        if ($days_away <= 5) {
            $this->taskRepo->setPriority(1, $task->id);
        } else if ($days_away <= 12) {
            $this->taskRepo->setPriority(2, $task->id);
        } else {
            $this->taskRepo->setPriority(3, $task->id);
        }
    }

    /**
     * @param $task
     * @param $db_task
     * @return int
     */
    public function getDate($task, $db_task)
    {
        $dt = new Carbon($db_task->due_date);

        $dt->subDays($task->completion_time);

        $days_away = $dt->diffInDays($this->carbon->now());
        return $days_away;
    }
}
