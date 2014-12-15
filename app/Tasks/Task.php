<?php namespace TGLD\Tasks;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use TGLD\Tasks\Events\TaskWasAccepted;
use TGLD\Tasks\Events\TaskWasCompleted;
use TGLD\Tasks\Events\TaskWasPosted;
use TGLD\Tasks\Events\TaskWasStarted;
use TGLD\Tasks\Events\TaskWasUpdated;

class Task extends Model
{
    use EventGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'slug', 'file_url', 'description', 'assigned_from', 'priority', 'assigned_to', 'project_id', 'due_date', 'related_link', 'website_link'];


    /*
    |--------------------------------------------------------------------------
    | Extra Functions
    |--------------------------------------------------------------------------
    |
    | Miscellaneous functions
    |
    */

    /*
	|--------------------------------------------------------------------------
	| Command Functions
	|--------------------------------------------------------------------------
	|
	| Functions needed for the command bus
	| none of these functions persist to the database
	|
	*/

    /**
     * Add a new task
     *
     * @param $title
     * @param $file_url
     * @param $description
     * @param $assigned_from
     * @param $assigned_to
     * @param $project_id
     * @param $due_date
     * @param $slug
     * @param $related_link
     * @param $website_link
     * @return static
     */
    public static function addTask($title, $file_url, $description, $assigned_from, $assigned_to, $project_id, $due_date, $slug, $related_link, $website_link)
    {
        $task = new static(compact('title', 'file_url', 'description', 'assigned_from', 'assigned_to', 'project_id', 'due_date', 'slug', 'related_link', 'website_link'));

        $task->raise(new TaskWasPosted($task));

        return $task;
    }

    /**
     * @param $comment
     * @param $task_id
     * @return static
     */
    public static function postComment($comment, $task_id)
    {
        $comments = new static(compact('comment', 'task_id'));

        return $comments;
    }

    /**
     * @param $title
     * @param $description
     * @param $assigned_from
     * @param $assigned_to
     * @param $project_id
     * @param $due_date
     * @param $id
     * @param $slug
     * @param $related_link
     * @param $website_link
     * @return static
     */
    public static function updateTask($title, $description, $assigned_from, $assigned_to, $project_id, $due_date, $id, $slug, $related_link, $website_link)
    {
        $task = new static(compact('title', 'description', 'assigned_from', 'assigned_to', 'project_id', 'due_date', 'id', 'slug', 'related_link', 'website_link'));

        $task->raise(new TaskWasUpdated($task));

        return $task;
    }

    /**
     * @param $id
     * @return static
     */
    public static function acceptTask($id)
    {
        $task = new static(compact('id'));

        $task->raise(new TaskWasAccepted($task));

        return $task;
    }

    /**
     * Update task to start
     *
     * @param $id
     * @return static
     */
    public static function startTask($id)
    {
        $task = new static(compact('id'));

        $task->raise(new TaskWasStarted($task));

        return $task;
    }

    /**
     * Complete the task
     *
     * @param $id
     * @return static
     */
    public static function completeTask($id)
    {
        $task = new static(compact('id'));

        $task->raise(new TaskWasCompleted($task));

        return $task;
    }

    public static function deleteTask($id)
    {
        $task_id = new static(compact('id'));

        return $task_id;
    }

    /*
	|--------------------------------------------------------------------------
	| Relationship Functions
	|--------------------------------------------------------------------------
	|
	| functions to declare relationships between models
	|
	*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignee()
    {
        return $this->belongsTo('TGLD\Members\Member', 'assigned_from');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('TGLD\Projects\Project', 'project_id');
    }

    /**
     * Relationship between assigned tasks and users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assignedUsers()
    {
        return $this->belongsToMany('TGLD\Members\Member', 'user_assigned_task', 'task_id', 'user_id');
    }

    /**
     * Relationship between accepted tasks and users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function acceptedUsers()
    {
        return $this->belongsToMany('TGLD\Members\Member', 'user_accepted_task', 'task_id', 'user_id');
    }

    /**
     * Relationship between started tasks and users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function startedUsers()
    {
        return $this->belongsToMany('TGLD\Members\Member', 'user_started_task', 'task_id', 'user_id');
    }

    /**
     * Relationship between completed tasks and users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function completedUsers()
    {
        return $this->belongsToMany('TGLD\Members\Member', 'user_completed_task', 'task_id', 'user_id');
    }

    /**
     * Relationship between tasks and its comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->morphMany('TGLD\Comments\Comment', 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taskDetails()
    {
        return $this->hasOne('TGLD\Tasks\TaskDetail');
    }

}