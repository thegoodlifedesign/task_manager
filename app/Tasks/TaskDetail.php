<?php namespace TGLD\Tasks;

use Illuminate\Database\Eloquent\Model;

class TaskDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'task_id', 'website_link', 'related_link', 'due_date'];

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
    public function task()
    {
        return $this->belongsTo('TGLD\Tasks\Task');
    }

}