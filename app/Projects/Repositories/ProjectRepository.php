<?php namespace TGLD\Projects\Repositories;

use TGLD\Core\EloquentRepository;
use TGLD\Projects\Project;

class ProjectRepository extends EloquentRepository
{
    function __construct(Project $model)
    {
        $this->model = $model;
    }

    /**
     * Get the project id by its slug
     *
     * @param $project_slug
     * @return mixed
     */
    public function getIdBySlug($project_slug)
    {
        return $this->model->where('slug', '=', $project_slug)->first();
    }

    /**
     * Save a new project to the db
     *
     * @param $project
     */
    public function saveProject($project)
    {

        $this->model->title = $project->title;
        $this->model->description = $project->description;
        $this->model->slug = $project->slug;

        $this->model->save();

    }
}