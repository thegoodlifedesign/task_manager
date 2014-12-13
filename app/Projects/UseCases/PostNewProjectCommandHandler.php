<?php namespace TGLD\Projects\UseCases;

use Laracasts\Commander\CommandHandler;
use TGLD\Projects\Project;
use TGLD\Projects\Repositories\ProjectRepository;

class PostNewProjectCommandHandler implements CommandHandler
{
    protected $project;

    function __construct(ProjectRepository $project)
    {
        $this->project = $project;
    }


    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $project = Project::addProject($command->name, $command->description);

        $this->project->saveProject($project);

        return $project;
    }
}