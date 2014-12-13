<?php namespace TGLD\Projects\UseCases;


class PostNewProjectCommand
{
    public $name;

    public $description;

    function __construct($description, $name)
    {
        $this->description = $description;
        $this->name = $name;
    }


} 