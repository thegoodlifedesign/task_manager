<?php namespace TGLD\Http\Controllers\Tasks;

use TGLD\Http\Requests\Tasks\CompleteTaskRequest;
use TGLD\Tasks\UseCases\CompletedTaskCommand;
use TGLD\Utilities\Flash\Flash;

class CompletedTaskController extends AbstractTaskController
{
    /**
     * Get all completed task for that specific user
     *
     * @Get("{username}/completed-tasks", as="completed-tasks")
     *
     * @param $username
     * @return \Illuminate\View\View
     */
    public function getCompletedTasks($username)
    {
        $tasks = $this->taskService->completedTasks($username);

        return view('task.completed-tasks', compact('tasks', 'username'));
    }

    /**
     * Declare that a user has completed the task
     *
     * @param CompleteTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCompleteTask(CompleteTaskRequest $request)
    {
        $this->execute(CompletedTaskCommand::class);

        Flash::message('Congratulations on completing the task!');

        return redirect()->back();
    }
}