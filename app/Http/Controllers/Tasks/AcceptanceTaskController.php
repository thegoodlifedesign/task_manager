<?php namespace TGLD\Http\Controllers\Tasks;

use TGLD\Tasks\UseCases\AcceptedTaskCommand;
use TGLD\Utilities\Flash\Flash;

class AcceptanceTaskController extends AbstractTaskController
{
    /**
     * Display the tasks assigned to $username.
     *
     * @Get("{username}/accepted-tasks", as="accepted-tasks")
     *
     * @param  string $username
     * @return Response
     */
    public function getAcceptedTasks($username)
    {
        $tasks = $this->taskService->acceptedTasks($username);

        return view('task.accepted-tasks', compact('tasks', 'username'));
    }

    /**
     * Accept a task
     *
     * @Post("task/accept", as="accept-task")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAcceptTask()
    {
        $this->execute(AcceptedTaskCommand::class);

        Flash::message('Task Has Been Accepted');

        return redirect()->back();
    }
}