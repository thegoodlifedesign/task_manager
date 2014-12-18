<?php namespace TGLD\Tasks\Repositories;

use Carbon\Carbon;
use Illuminate\Auth\Guard;
use TGLD\Core\EloquentRepository;
use TGLD\Tasks\Task;

class TaskRepository extends EloquentRepository
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @param Task $model
     * @param Guard $auth
     */
    function __construct(Task $model, Guard $auth)
    {
        $this->auth = $auth;
        $this->model = $model;
    }


    /**
     * @param $task
     * @return Task
     */
    public function saveTask($task)
    {
        $this->model->title = $task->title;
        $this->model->slug = $task->slug;
        $this->model->file_url = $task->file_url;
        $this->model->description = $task->description;
        $this->model->assigned_from = $task->assigned_from;
        $this->model->project_id = $task->project_id;

        $this->model->save();

        $this->model->assignedUsers()->attach($task->assigned_to);

        return $this->model;
    }

    /**
     * @param $task
     */
    public function denyTask($task)
    {
        $itask = $this->model->where('id', '=', $task->id)->first();

        $itask->assignedUsers()->updateExistingPivot($this->auth->user()->id, ['denied' => 1]);
    }

    /**
     * Update a task
     *
     * @param $task
     */
    public function updateTask($task)
    {
        $taski = $this->model->where('id', '=', $task->id)->first();

        $taski->title = $task->title;
        $taski->slug = $task->slug;
        $taski->description = $task->description;
        $taski->project_id = $task->project_id;

        $taski->save();

        if($task->assigned_to != null) {
            $taski->assignedUsers()->attach($task->assigned_to);
        }
    }

    /**
     * Accept a new task
     *
     * @param $task
     */
    public function acceptTask($task)
    {
        $itask = $this->model->where('id', '=', $task->id)->first();

        if($itask->accepted_at == '0000-00-00 00:00:00')
        {
            $itask->stage = 2;
            $itask->accepted_at = Carbon::now();

            $itask->save();
        }

        $itask->assignedUsers()->detach($this->auth->user()->id);
        $itask->acceptedUsers()->attach($this->auth->user()->id);
    }

    /**
     * Start as task
     *
     * @param $task
     */
    public function startTask($task)
    {
        $itask = $this->model->where('id', '=', $task->id)->first();

        if($itask->started_at == '0000-00-00 00:00:00')
        {
            $itask->stage = 3;
            $itask->started_at = Carbon::now();

            $itask->save();
        }

        $itask->acceptedUsers()->detach($this->auth->user()->id);
        $itask->startedUsers()->attach($this->auth->user()->id);
    }

    /**
     * Complete a task
     *
     * @param $task
     */
    public function completeTask($task)
    {
        $itask = $this->model->where('id', '=', $task->id)->first();

        if($itask->completed_at == '0000-00-00 00:00:00')
        {
            $itask->stage = 4;
            $itask->completed_at = Carbon::now();

            $itask->save();
        }

        $itask->startedUsers()->detach($this->auth->user()->id);
        $itask->completedUsers()->attach($this->auth->user()->id);
    }

    /**
     * Return the first task
     * that matches the slug
     *
     * @param $task_slug
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getTaskBySlug($task_slug)
    {
        return  $this->model->with('assignedUsers', 'assignee', 'project', 'comments', 'comments.author')->where('slug', '=', $task_slug)->first();
    }

    /**
     * Return all of the task that match the slug
     *
     * @param $task_slug
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllTasksBySlug($task_slug)
    {
        return  $this->model->with('assignedUser', 'assignee', 'project')->where('slug', '=', $task_slug)->get();
    }

    /**
     * Get the project name through the project id
     *
     * @param $project_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByProjectId($project_id)
    {
        return $this->model->with('project')->where('project_id', '=', $project_id)->get();
    }


    /**
     * @param $slug
     * @return mixed
     */
    public function getAllIdBySlug($slug)
    {
        return  $this->model->with('assignedUser', 'assignee', 'project')->select('id', 'slug')->where('slug', '=', $slug)->get();
    }

    /**
     * @param $task
     * @return mixed
     */
    public function deleteTask($task)
    {
        $itask = $this->model->where('id', '=', $task->id)->first();

        $itask->delete();

        return $itask;
    }

    /**
     * @param $priority
     * @param $id
     */
    public function setPriority($priority, $id)
    {
        $task = $this->model->where('id', '=', $id)->first();

        $task->priority = $priority;

        $task->save();
    }

    public function getFromTaskIds($task_ids)
    {
        return $this->model->whereIn('id', $task_ids)->get();
    }

}