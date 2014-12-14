<?php namespace TGLD\Decorators;

use Laracasts\Commander\CommandBus;
use TGLD\Utilities\Sluger\Sluger;

class ProjectSlugGenerator implements CommandBus
{
    protected $sluger;

    function __construct(Sluger $sluger)
    {
        $this->sluger = $sluger;
    }

    /**
     * Execute a command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        $slug = $this->sluger->sluggify($command->title);

        $slug_exists = $this->sluger->checkProjectTitleSlugExist($slug);

        if( ! $slug_exists){ return $command->slug = $slug;}

        return $command->slug = $slug.rand(99,9999);
    }
}