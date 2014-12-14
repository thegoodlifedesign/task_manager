<?php namespace TGLD\Tasks\UseCases;


class UpdateTaskCommand
{
    public $assigned_from;

    public $assigned_to;

    public $project;

    public $title;

    public $description;

    public $priority;

    public $id;

    function __construct($assigned_from, $assigned_to, $description, $priority, $project, $title, $id)
    {
        $this->assigned_from = $assigned_from;
        $this->assigned_to = $assigned_to;
        $this->description = $description;
        $this->priority = $priority;
        $this->project = $project;
        $this->title = $title;
        $this->id = $id;
    }


} 