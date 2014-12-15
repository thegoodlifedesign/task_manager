<?php namespace TGLD\Tasks\UseCases;


class PostNewTaskCommand
{
    public $assigned_from;

    public $assigned_to;

    public $project;

    public $title;

    public $description;

    public $due_date;

    public $file_url;

    public $related_link;

    public $website_link;

    function __construct($assigned_from, $assigned_to, $project, $title, $description, $due_date, $file_url = null, $related_link = null, $website_link = null)
    {
        $this->assigned_from = $assigned_from;
        $this->assigned_to = $assigned_to;
        $this->project = $project;
        $this->title = $title;
        $this->description = $description;
        $this->due_date = $due_date;
        $this->file_url = $file_url;
        $this->related_link = $related_link;
        $this->website_link = $website_link;
    }


} 