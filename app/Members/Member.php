<?php namespace TGLD\Members;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;
use Laracasts\Commander\Events\EventGenerator;
use TGLD\Members\Events\MemberWasActivated;
use TGLD\Members\Events\MemberWasRegistered;

class Member extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EventGenerator;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'username', 'password', 'slug'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/*
	|--------------------------------------------------------------------------
	| Extra Functions
	|--------------------------------------------------------------------------
	|
	| Miscellaneous functions
	|
	*/

	/**
	 * Hash password automatically when user signs up
	 *
	 * @param $password
	 * @internal param $pass
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}

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
	 * Register a new member
	 *
	 * @param $first_name
	 * @param $last_name
	 * @param $email
	 * @param $username
	 * @param $password
	 * @param $slug
	 * @return static
     */
	public static function register($first_name, $last_name, $email, $username, $password, $slug)
	{
		$member = new static(compact('first_name', 'last_name', 'email', 'username', 'password', 'slug'));

		$member->raise(new MemberWasRegistered($member));

		return $member;
	}

	/**
	 * Activate the new member
	 *
	 * @param $activate_token
	 * @return static
     */
	public static function activate($activate_token)
	{
		$token = new static(compact('activate_token'));

		$token->raise(new MemberWasActivated($token));

		return $token;
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
	 * Relationship between assigned tasks and users
	 *
	 * @return mixed
	 */
	public function assignedTasks()
	{
		return $this->belongsToMany('TGLD\Tasks\Task', 'user_assigned_task', 'user_id', 'task_id')
			->withPivot('denied')
			->with('project')
			->where('denied', '=', 0)
			->orderBy('priority', 'ASC')
			->latest();
	}

	/**
	 * Relationship between accepted tasks and users
	 *
	 * @return mixed
	 */
	public function acceptedTasks()
	{
		return $this->belongsToMany('TGLD\Tasks\Task', 'user_accepted_task', 'user_id', 'task_id')
			->with('project')
			->orderBy('priority', 'ASC')
			->latest();
	}

	/**
	 * Relationship between started tasks and user
	 *
	 * @return mixed
	 */
	public function startedTasks()
	{
		return $this->belongsToMany('TGLD\Tasks\Task', 'user_started_task', 'user_id', 'task_id')
			->with('project')
			->orderBy('priority', 'ASC')
			->latest();
	}

	/**
	 * Relationship between completed tasks and user
	 *
	 * @return mixed
	 */
	public function completedTasks()
	{
		return $this->belongsToMany('TGLD\Tasks\Task', 'user_completed_task', 'user_id', 'task_id')
			->with('project')
			->orderBy('priority', 'ASC')
			->latest();
	}

	public function comment()
	{
		return $this->hasMany('TGLD\Comments\Comment');
	}

}
