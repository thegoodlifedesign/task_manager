<?php namespace TGLD\Http\Controllers\Projects;


use TGLD\Http\Controllers\CommandController;
use TGLD\Http\Requests\Projects\ProjectRequest;
use TGLD\Projects\Services\projectService;
use TGLD\Projects\UseCases\PostNewProjectCommand;
use TGLD\Tasks\Services\TaskService;
use TGLD\Utilities\Flash\Flash;


class ProjectController extends CommandController
{
    /**
     * @var projectService
     */
    protected $projectService;

    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * @param projectService $projectService
     * @param TaskService $taskService
     */
    function __construct(ProjectService $projectService, TaskService $taskService)
    {
        $this->projectService = $projectService;
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = $this->projectService->all();

        return view('project.all-projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return Response
     */
    public function store(ProjectRequest $request)
    {
        $this->execute(PostNewProjectCommand::class,null,[
            'TGLD\Decorators\ProjectSlugGenerator'
        ]);

        Flash::message('Project Created!');

        return redirect()->back();
    }

    /**
     * Show all projects belonging to a user
     *
     * @internal param int $id
     * @param $username
     * @return \Illuminate\View\View
     */
    public function show($username)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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

}
