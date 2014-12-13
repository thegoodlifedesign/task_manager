<?php namespace TGLD\Projects\Services;

use TGLD\Projects\Repositories\ProjectRepository;

class projectService
{
    protected $project;

    function __construct(ProjectRepository $project)
    {
        $this->project = $project;
    }

    /**
     * Get all projects
     *
     * @return mixed
     */
    public function all()
    {
        $projects = $this->project->getLatest();

        return $projects;
    }
} 