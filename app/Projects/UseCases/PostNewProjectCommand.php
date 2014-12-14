<?php namespace TGLD\Projects\UseCases;


class PostNewProjectCommand
{
    public $title;

    public $description;

    function __construct($description, $title)
    {
        $this->description = $description;
        $this->title = $title;
    }


} 