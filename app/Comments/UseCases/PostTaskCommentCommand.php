<?php namespace TGLD\Comments\UseCases;

class PostTaskCommentCommand
{
    public  $comment;
    public $task_id;

    function __construct($comment, $task_id)
    {
        $this->comment = $comment;
        $this->task_id = $task_id;
    }
} 