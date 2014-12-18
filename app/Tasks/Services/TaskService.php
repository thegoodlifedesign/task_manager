<?php namespace TGLD\Tasks\Services;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use TGLD\Members\Repositories\MemberRepository;
use TGLD\Projects\Exceptions\ProjectNotFoundException;
use TGLD\Projects\Repositories\ProjectRepository;
use TGLD\Task\Exceptions\TaskNotFoundException;
use TGLD\Tasks\Repositories\TaskRepository;
use TGLD\Tasks\Repositories\TaskStatisticRepository;

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
     * @var TaskStatisticRepository
     */
    private $taskStatRepo;

    /**
     * @param TaskRepository $task
     * @param MemberRepository $member
     * @param ProjectRepository $project
     */
    function __construct(TaskRepository $task, MemberRepository $member, ProjectRepository $project, TaskStatisticRepository $taskStatRepo)
    {
        $this->member = $member;
        $this->task= $task;
        $this->project = $project;
        $this->taskStatRepo = $taskStatRepo;
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

    public function getPersonalProjectTasks($username, $project_slug)
    {
        $project_task_ids = $this->getProjectTasks($project_slug);

        if( ! is_null($project_task_ids))
        {
            $user_task_ids = $this->getUserTasks($username);

            $task_ids = $this->filterProjectAndUserTasks($user_task_ids, $project_task_ids);

            $tasks = $this->task->getFromTaskIds($task_ids);
            return $tasks;
        }

        return null;
    }

    /**
     * @param $project_slug
     * @return array
     * @throws ProjectNotFoundException
     */
    public function getProjectTasks($project_slug)
    {
        $project = $this->project->getIdBySlug($project_slug);

        if (!$project) throw new ProjectNotFoundException;

        $project_tasks = $this->task->getByProjectId($project->id);

        if(count($project_tasks) > 0)
        {
            $project_task_ids = [];

            foreach ($project_tasks as $task) {
                $project_task_ids[] = $task->id;
            }
            return $project_task_ids;
        }
        return null;
    }

    /**
     * @param $username
     * @return array
     */
    public function getUserTasks($username)
    {
        $member = $this->member->getUserIdByUsername($username);

        if (!$member) throw new UsernameNotFoundException;

        $user_tasks = $this->taskStatRepo->getUserTasks($member->id);

        $user_task_ids = [];

        foreach ($user_tasks as $task) {
            $user_task_ids[] = $task->task_id;
        }
        return $user_task_ids;
    }

    /**
     * @param $user_task_ids
     * @param $project_task_ids
     * @return array
     */
    public function filterProjectAndUserTasks($user_task_ids, $project_task_ids)
    {
        $task_ids = [];

        foreach ($user_task_ids as $task_id) {
            if (in_array($task_id, $project_task_ids)) {
                $task_ids[] = $task_id;
            }
        }
        return $task_ids;
    }

}