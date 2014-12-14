<?php namespace TGLD\Http\Controllers\Tasks;


use Illuminate\Support\Facades\Route;

class AssignedTaskController extends AbstractTaskController
{

    /**
     * Display all the assigned tasks to the
     * specified user
     *
     * @param $username
     * @return \Illuminate\View\View
     */
    public function getAssignedTasks($username)
    {
        $tasks = $this->taskService->assignedTasks($username);

        return view('task.assigned-tasks', compact('tasks', 'username'));
    }
}