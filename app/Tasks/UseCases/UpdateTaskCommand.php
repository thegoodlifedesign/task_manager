<?php namespace TGLD\Tasks\UseCases;


class UpdateTaskCommand
{
    public $assigned_from;

    public $assigned_to;

    public $project;

    public $title;

    public $description;

    public $related_link;

    public $due_date;

    public $website_link;

    public $id;

    function __construct($assigned_from, $assigned_to = null, $project, $title, $description, $related_link, $due_date, $website_link, $id)
    {
        $this->assigned_from = $assigned_from;
        $this->assigned_to = $assigned_to;
        $this->project = $project;
        $this->title = $title;
        $this->description = $description;
        $this->related_link = $related_link;
        $this->due_date = $due_date;
        $this->website_link = $website_link;
        $this->id = $id;
    }


} 