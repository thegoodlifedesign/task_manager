<?php namespace TGLD\Tasks\Repositories;

use Illuminate\Contracts\Auth\Guard;
use TGLD\Core\EloquentRepository;
use TGLD\Tasks\TaskStatistic;

class TaskStatisticRepository extends EloquentRepository
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * @param TaskStatistic $model
     * @param Guard $auth
     */
    function __construct(TaskStatistic $model, Guard $auth)
    {
        $this->auth = $auth;
        $this->model = $model;
    }

    /**
     * Add a new task to the db
     *
     * @param $task
     */
    public function addTask($task)
    {

        foreach($task->assignedUsers as $user)
        {
            $taski = new TaskStatistic;

            $taski->task_id = $task->id;
            $taski->assigned_to = $user->id;

            $taski->save();
        }
    }

    public function updateTask($task)
    {
        
    }

    /**
     * Accept the task for the specified user
     *
     * @param $task_id
     */
    public function acceptTask($task_id)
    {
        $task = $this->model->where('task_id' , '=', $task_id)->where('assigned_to', '=', $this->auth->user()->id)->first();

        $task->accepted_by = $this->auth->user()->id;

        $task->save();
    }

    /**
     * Start the task for the specified user
     *
     * @param $task_id
     */
    public function startTask($task_id)
    {
        $task = $this->model->where('task_id' , '=', $task_id)->where('assigned_to', '=', $this->auth->user()->id)->where('accepted_by', '=', $this->auth->user()->id)->first();

        $task->started_by = $this->auth->user()->id;

        $task->save();
    }

    /**
     * Complete the task for the specified user
     *
     * @param $task_id
     */
    public function completeTask($task_id)
    {
        $task = $this->model
            ->where('task_id' , '=', $task_id)
            ->where('assigned_to', '=', $this->auth->user()->id)
            ->where('accepted_by', '=', $this->auth->user()->id)
            ->where('started_by', '=', $this->auth->user()->id)
            ->first();

        $task->completed_by = $this->auth->user()->id;

        $task->save();
    }

    /**
     * @param $task
     * @param $user_id
     * @return mixed
     */
    public function getAssignedTask($task, $user_id)
    {
        return $this->model->where('task_id', '=', $task->id)->where('assigned_to', '=', $user_id)->first();
    }


    /**
     * @param $task_id
     * @param $user_id
     * @return mixed
     */
    public function getAcceptedTask($task_id, $user_id)
    {
        return $this->model->select('id', 'task_id', 'accepted_by', 'started_by')->where('task_id', '=', $task_id)->where('accepted_by', '=', $user_id)->first();
    }

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getStartedTask($id, $user_id)
    {
        return $this->model
            ->select('id', 'started_by', 'accepted_by', 'completed_by')
            ->where('task_id', '=', $id)
            ->where('started_by', '=', $user_id)
            ->where('accepted_by', '=', $user_id)
            ->first();
    }

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function getCompletedTask($id, $user_id)
    {
        return $this->model
            ->select('id', 'started_by', 'accepted_by')
            ->where('id', '=', $id)
            ->where('started_by', '=', $user_id)
            ->where('accepted_by', '=', $user_id)
            ->where('completed_by', '=', $user_id)
            ->first();
    }

    /**
     * @param $task_id
     * @return mixed
     */
    public function getTaskByTaskId($task_id)
    {
        return $this->model->where('task_id', '=', $task_id)->get();
    }

    /**
     * @param $task_id
     * @return mixed
     */
    public function getTaskAcceptedUsers($task_id)
    {
        return $this->model->where('task_id', '=', $task_id)->where('accepted_by', '>=', '1')->get();
    }
}