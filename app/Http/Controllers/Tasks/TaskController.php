<?php namespace TGLD\Http\Controllers\Tasks;

use Illuminate\Contracts\Auth\Guard;
use TGLD\Http\Requests\Tasks\AddTaskRequest;
use TGLD\Http\Requests\Tasks\DeleteTaskRequest;
use TGLD\Http\Requests\Tasks\UpdateTaskRequest;
use TGLD\Tasks\UseCases\DeleteTaskCommand;
use TGLD\Tasks\UseCases\PostNewTaskCommand;
use TGLD\Tasks\UseCases\UpdateTaskCommand;
use TGLD\Utilities\Flash\Flash;

class TaskController extends AbstractTaskController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('task.add-task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddTaskRequest $request)
    {
        $this->execute(PostNewTaskCommand::class, null, [
            'TGLD\Decorators\FileUploader',
            'TGLD\Decorators\TaskFormSanitizer',
            'TGLD\Decorators\TaskSlugGenerator',
        ]);

        Flash::message('Task has been added!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param $project
     * @param $task_slug
     * @throws \TGLD\Task\Exceptions\TaskNotFoundException
     * @return \Illuminate\View\View
     */
    public function show($project, $task_slug)
    {
        $task = $this->taskService->taskDetails($task_slug);

        return view('task.task-details', compact('task'));
    }

    /**
     * Display the form to update a task
     *
     * @Get("{project}/{task}/update", as="update-task")
     *
     * @param $project_slug
     * @param $task_slug
     * @return \Illuminate\View\View
     */
    public function edit($project_slug, $task_slug)
    {
        $task = $this->taskService->taskDetails($task_slug);

        return view('task.update-task', compact('task'));
    }

    /**
     * Update the task
     *
     * @Post("{project}/{task}/update", as="update-task")
     *
     * @param UpdateTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request)
    {
        $task =  $this->execute(UpdateTaskCommand::class, null, [
            'TGLD\Decorators\TaskFormSanitizer',
            'TGLD\Decorators\TaskSlugGenerator',
        ]);

        Flash::message('Task was updated!');

        return redirect()->route('update.task', $attributes = ['project' => $task->project->slug, 'task' => $task->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteTaskRequest $request
     * @param Guard $auth
     * @internal param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DeleteTaskRequest $request)
    {
        $task = $this->execute(DeleteTaskCommand::class);

        Flash::message('Task has been deleted');

            return redirect()->route('assigned.tasks', $attributes = ['username' => $task->assignee->username]);
    }
}