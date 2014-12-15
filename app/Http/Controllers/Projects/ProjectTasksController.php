<?php namespace TGLD\Http\Controllers\Projects;

class ProjectTasksController extends AbstractProjectController
{
    /**
     * @param $project_slug
     * @return \Illuminate\View\View
     */
    public function getAllTasks($project_slug)
    {
        $tasks = $this->taskService->projectTasks($project_slug);
        return view('project.show', compact('tasks'));
    }

    /**
     * @param $username
     * @param $project_slug
     * @return \Illuminate\View\View
     */
    public function getPersonalTasks($username, $project_slug)
    {
        $tasks = $this->taskService->personalProjectTasks($username, $project_slug);
        return view('project.show', compact('tasks'));
    }
}