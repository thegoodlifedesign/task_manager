<?php namespace TGLD\Http\Controllers\Tasks;

use TGLD\Http\Requests\StartTaskRequest;
use TGLD\Tasks\UseCases\StartTaskCommand;
use TGLD\Utilities\Flash\Flash;

class StartedTaskController extends AbstractTaskController
{
    /**
     * Display a list of started tasks
     *
     * @Get("{username}/started-tasks", as="started-tasks")
     *
     * @param $username
     * @return \Illuminate\View\View
     */
    public function getStartedTasks($username)
    {
        $tasks = $this->taskService->startedTasks($username);

        return view('task.started-tasks', compact('tasks', 'username'));
    }

    /**
     * Process the start of a task
     *
     * @Post("task/start", as="start-task")
     *
     * @param StartTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStartTask(StartTaskRequest $request)
    {
        $this->execute(StartTaskCommand::class);

        Flash::message('Task has been started');

        return redirect()->back();
    }
}