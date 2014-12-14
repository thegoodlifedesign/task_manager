<?php namespace TGLD\Projects;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Commander\Events\EventGenerator;

class Project extends Model
{
    use EventGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'description', 'slug'];

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
     * Add a project with out persisting it yet
     *
     * @param $title
     * @param $description
     * @param $slug
     * @return static
     */
    public static function addProject($title, $description, $slug)
    {
        $project = new static(compact('title', 'description', 'slug'));

        return $project;
    }
}