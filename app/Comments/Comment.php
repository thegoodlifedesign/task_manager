<?php namespace TGLD\Comments;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'commentable_id', 'commentable_type', 'comment', 'task_id'];

    public static function postTaskComment($comment, $task_id)
    {
       return  new static(compact('comment', 'task_id'));
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo('TGLD\Members\Member', 'user_id');
    }
} 