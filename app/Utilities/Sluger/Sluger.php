<?php namespace TGLD\Utilities\Sluger;

use TGLD\Members\Repositories\MemberRepository;
use TGLD\Tasks\Repositories\TaskRepository;

class Sluger
{
    protected $memberRepo;

    protected $taskRepo;

    function __construct(MemberRepository $memberRepo, TaskRepository $taskRepo)
    {
        $this->memberRepo = $memberRepo;
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

    public function checkUsernameSlugExist($slug)
    {
        $slug_exist = $this->memberRepo->getSlug($slug);

        if( ! $slug_exist){ return false;}

        return true;
    }

    public function checkTitleSlugExist($slug)
    {
        $slug_exist = $this->taskRepo->getSlug($slug);

        if( ! $slug_exist){ return false;}

        return true;
    }
}