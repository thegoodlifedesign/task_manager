<?php namespace TGLD\Http\Controllers\Comments;

use TGLD\Http\Requests\Tasks\AddTaskCommentRequest;
use TGLD\Comments\UseCases\PostTaskCommentCommand;
use TGLD\Http\Controllers\CommandController;
use TGLD\Utilities\Flash\Flash;

class TaskCommentController extends CommandController
{
    /**
     * Add a comment to a task
     *
     * @Post("task/add-comment", as="task-add-comment")
     *
     * @param AddTaskCommentRequest $request
     * @return mixed
     */
    public function postTaskComment(AddTaskCommentRequest $request)
    {
        $this->execute(PostTaskCommentCommand::class);

        Flash::message('Your comment has been added');

        return redirect()->back();
    }
}