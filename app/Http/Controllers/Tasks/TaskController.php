<?php namespace TGLD\Http\Controllers\Tasks;

use TGLD\Http\Requests\AddTaskRequest;
use TGLD\Http\Requests\UpdateTaskRequest;
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
        //
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
            'TGLD\Decorators\TitleSlugGenerator',
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
            'RL\Decorators\TaskFormSanitizer',
            'RL\Decorators\FileUploader'
        ]);

        Flash::message('Task was updated!');

        return redirect()->route('update-task', $attributes = ['project' => $task->project->slug, 'task' => $task->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get the download link to a file
     * in a task
     *
     * @Get("{project}/{task}/{download}", as="download-task")
     *
     * @param $project
     * @param $task
     * @param $download
     * @internal param $download_url
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getDownloadFile($project, $task ,$download)
    {
        $file = public_path(). "/media/file_uploads/$download";

        return response()->download($file, $download);
    }
}