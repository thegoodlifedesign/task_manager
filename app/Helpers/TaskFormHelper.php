<?php namespace TGLD\Helpers;

use TGLD\Members\Repositories\MemberRepository;
use TGLD\Projects\Repositories\ProjectRepository;
use TGLD\Tasks\Repositories\TaskStatisticRepository;
use TGLD\Tasks\Repositories\TaskRepository;

class TaskFormHelper
{
    protected $memberRepo;

    protected $projectsRepo;

    protected $taskRepo;

    protected $taskStatRepo;

    function __construct(ProjectRepository $projectsRepo, TaskRepository $taskRepo, MemberRepository $memberRepo, TaskStatisticRepository $taskStatRepo)
    {
        $this->memberRepo = $memberRepo;
        $this->projectsRepo = $projectsRepo;
        $this->taskRepo = $taskRepo;
        $this->taskStatRepo = $taskStatRepo;
    }

    /**
     * Display all the projects for adding a new task
     *
     */
    public function selectProjects()
    {
        $projects = $this->projectsRepo->getLatest();

        foreach($projects as $project)
        {
            echo "<option value='{$project->id}'>{$project->title}</option>";
        }
    }

    /**
     * Display the selected project and
     * the other remaining projects
     * to update a task
     *
     * @param $selected_project
     */
    public function updateProjects($selected_project)
    {
        $projects = $this->projectsRepo->getAll();

        echo "<option value='{$selected_project->id}'>{$selected_project->title}</option>";

        foreach($projects as $project)
        {
            if($project->id != $selected_project->id)
            {
                echo "<option value='{$project->id}'>{$project->title}</option>";
            }
        }
    }

    /**
     * Display all the users that can be assigned a task
     * when adding a new task
     *
     */
    public function selectUsers()
    {
        $members = $this->memberRepo->getAllActive();

        foreach($members as $member)
        {
                echo "<div class='checkbox'>
                      <label>
                        <input name='assigned_to[]' type='checkbox' value='{$member->id}'>
                        {$member->username}
                      </label>
                </div>";
        }
    }

    /**
     * Show the assigned users for task
     * and also the remaining non-assigned users
     *
     * @param $task
     */
    public function updateUsers($task)
    {
        $members = $this->memberRepo->getAllActive();

        $tasks = $this->taskStatRepo->getTaskByTaskId($task->id);

        $assigned_users = [];

        foreach($tasks as $t)
        {
            $assigned_users[] = $t->assigned_to;
        }

        foreach($members as $member)
        {
            if(! in_array($member->id, $assigned_users))
            {
                echo "<div class='checkbox'>
                        <label>
                        <input name='assigned_to[]' type='checkbox' value='{$member->id}'>{$member->username}
                        </label>
                      </div>";
            }
        }
    }

}