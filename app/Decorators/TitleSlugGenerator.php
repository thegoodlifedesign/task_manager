<?php namespace TGLD\Decorators;


use Laracasts\Commander\CommandBus;
use TGLD\Utilities\Sluger\Sluger;

class TitleSlugGenerator implements CommandBus
{
    protected
    $sluger;

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
        $command->slug = $this->sluger->sluggify($command->title);
    }
}