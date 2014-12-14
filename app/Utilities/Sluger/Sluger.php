<?php namespace TGLD\Utilities\Sluger;

use TGLD\Members\Repositories\MemberRepository;
use TGLD\Projects\Repositories\ProjectRepository;
use TGLD\Tasks\Repositories\TaskRepository;

class Sluger
{
    /**
     * @var MemberRepository
     */
    protected $memberRepo;

    /**
     * @var ProjectRepository
     */
    protected $projectRepo;

    /**
     * @var TaskRepository
     */
    protected $taskRepo;

    /**
     * @param MemberRepository $memberRepo
     * @param TaskRepository $taskRepo
     * @param ProjectRepository $projectRepo
     */
    function __construct(MemberRepository $memberRepo, TaskRepository $taskRepo, ProjectRepository $projectRepo)
    {
        $this->memberRepo = $memberRepo;
        $this->projectRepo = $projectRepo;
        $this->taskRepo = $taskRepo;
    }

    /**
     * Slug any string
     *
     * @param $str
     * @return mixed|string
     */
    public function sluggify($str)
   {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

        return $clean;
    }

    /**
     * @param $slug
     * @return bool
     */
    public function checkUsernameSlugExist($slug)
    {
        $slug_exist = $this->memberRepo->getSlug($slug);

        if( ! $slug_exist){ return false;}

        return true;
    }

    /**
     * @param $slug
     * @return bool
     */
    public function checkTaskTitleSlugExist($slug)
    {
        $slug_exist = $this->taskRepo->getSlug($slug);

        if( ! $slug_exist){ return false;}

        return true;
    }

    /**
     * @param $slug
     * @return bool
     */
    public function checkProjectTitleSlugExist($slug)
    {
        $slug_exist = $this->projectRepo->getSlug($slug);

        if( ! $slug_exist){ return false;}

        return true;
    }
}