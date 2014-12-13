<?php namespace TGLD\Comments\UseCases;

use Laracasts\Commander\CommandHandler;
use TGLD\Comments\Comment;
use TGLD\Comments\Repositories\CommentRepository;

class PostTaskCommentCommandHandler implements CommandHandler
{
    protected $commentRepo;

    function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $comment = Comment::postTaskComment($command->comment, $command->task_id);

        $this->commentRepo->addTaskComment($comment);

        return $comment;
    }
}