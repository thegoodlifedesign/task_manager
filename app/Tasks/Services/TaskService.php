<?php namespace TGLD\Tasks\Services;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use TGLD\Members\Repositories\MemberRepository;
use TGLD\Projects\Exceptions\ProjectNotFoundException;
use TGLD\Projects\Repositories\ProjectRepository;
use TGLD\Task\Exceptions\TaskNotFoundException;
use TGLD\Tasks\Repositories\TaskRepository;

class TaskService
{
    /**
     * @var MemberRepository
     */
    protected $member;

    /**
     * @var ProjectRepository
     */
    protected $project;

    /**
     * @var TaskRepository
     */
    protected  $task;

    /**
     * @param TaskRepository $task
     * @param MemberRepository $member
     * @param ProjectRepository $project
     */
    function __construct(TaskRepository $task, MemberRepository $member, ProjectRepository $project)
    {
        $this->member = $member;
        $this->task= $task;
        $this->project = $project;
    }

    /**
     * Get all of the assigned task pertaining to the $username
     *
     * @param $username
     * @return mixed
     */
    public function assignedTasks($username)
    {
        $member = $this->member->getUserIdByUsername($username);

        if( ! $member) throw new UsernameNotFoundException;

        return $member->assignedTasks;
    }

    /**
     * Get all of the accepted task pertaining to the $username
     *
     * @param $username
     * @return mixed
     */
    public function acceptedTasks($username)
    {
        $member = $this->member->getUserIdByUsername($username);

        if( ! $member) throw new UsernameNotFoundException;

        return $member->acceptedTasks;

    }

    /**
     * Retrieve all the started tasks
     *
     * @param $username
     * @return mixed
     */
    public function startedTasks($username)
    {
        $member = $this->member->getUserIdByUsername($username);

        if( ! $member) throw new UsernameNotFoundException;

        return $member->startedTasks;
    }

    /**
     * Get all the completed task for specific user
     *
     * @param $username
     * @return mixed
     */
    public function completedTasks($username)
    {
        $member = $this->member->getUserIdByUsername($username);

        if( ! $member) throw new UsernameNotFoundException;

        return $member->completedTasks;
    }

    /**
     * get the task details of
     * the specified task
     *
     * @param $task_slug
     * @return \Illuminate\Database\Eloquent\Model|null|static
     * @throws TaskNotFoundException
     */
    public function taskDetails($task_slug)
    {
        $task = $this->task->getTaskBySlug($task_slug);

        if(!$task) throw new TaskNotFoundException;

        return $task;
    }

    /**
     * get all of the task
     * belonging to $project_slug
     *
     * @param $project_slug
     * @return mixed
     * @throws ProjectNotFoundException
     */
    public function projectTasks($project_slug)
    {
        $project = $this->project->getIdBySlug($project_slug);

        if(!$project) throw new ProjectNotFoundException;

        return $this->task->getByProjectId($project->id);
    }

}