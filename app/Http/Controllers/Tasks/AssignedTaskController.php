<?php namespace TGLD\Http\Controllers\Tasks;

use TGLD\Http\Requests\Tasks\DenyTaskRequest;
use TGLD\Tasks\UseCases\DenyTaskCommand;
use TGLD\Utilities\Flash\Flash;

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

    /**
     * @param DenyTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDenyTask(DenyTaskRequest $request)
    {
        $this->execute(DenyTaskCommand::class);

        Flash::message('Task has been denied!');

        return redirect()->back();
    }
}