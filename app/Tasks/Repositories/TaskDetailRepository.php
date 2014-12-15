<?php namespace TGLD\Tasks\Repositories;

use TGLD\Core\EloquentRepository;
use TGLD\Tasks\TaskDetail;

class TaskDetailRepository extends EloquentRepository
{
    /**
     * @var TaskRepository
     */
    private $taskRepo;

    function __construct(TaskDetail $model, TaskRepository $taskRepo)
    {
        $this->model = $model;
        $this->taskRepo = $taskRepo;
    }

    public function addDetail($task)
    {
        $new_task = $this->taskRepo->getTaskBySlug($task->slug);

        $new_task_id = $new_task->id;

        $this->model->task_id = $new_task_id;
        $this->model->website_link = $task->website_link;
        $this->model->related_link = $task->related_link;
        $this->model->due_date = $task->due_date;

        $this->model->save();
    }

    public function updateDetail($task)
    {
        $new_task = $this->taskRepo->getTaskBySlug($task->slug);
        $new_task_id = $new_task->id;

        $itask = $this->model->where('task_id', '=', $new_task_id)->first();

        $itask->website_link = $task->website_link;
        $itask->related_link = $task->related_link;
        $itask->due_date = $task->due_date;

        $itask->save();
    }
}