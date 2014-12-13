<?php namespace TGLD\Comments\Repositories;

use Illuminate\Contracts\Auth\Guard;
use TGLD\Comments\Comment;
use TGLD\Core\EloquentRepository;
use TGLD\Tasks\Task;

class CommentRepository extends EloquentRepository
{
    protected $auth;

    function __construct(Comment $model, Guard $auth)
    {
        $this->auth = $auth;
        $this->model = $model;
    }

    public function addTaskComment($comment)
    {
        $task = Task::find($comment->task_id);

        $this->model->user_id = $this->auth->user()->id;
        $this->model->comment = $comment->comment;

        $task->comments()->save($this->model);
    }
}