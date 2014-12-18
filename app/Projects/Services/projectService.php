<?php namespace TGLD\Projects\Services;

use TGLD\Members\Repositories\MemberRepository;
use TGLD\Projects\Repositories\ProjectRepository;

class projectService
{
    protected $projectRepo;

    function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    /**
     * Get all projects
     *
     * @return mixed
     */
    public function all()
    {
        $projects = $this->projectRepo->getLatest();

        return $projects;
    }
} 