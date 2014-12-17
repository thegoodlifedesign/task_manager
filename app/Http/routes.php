<?php

$router->get('/', ['as' => 'home', 'uses' => 'HomeController@showHome']);

/*
|--------------------------------------------------------------------------
| Password Reset Controllers
|--------------------------------------------------------------------------
|
| These two controllers handle the authentication of the users of your
| application, as well as the functions necessary for resetting the
| passwords for your users. You may modify or remove these files.
|
*/

Route::controllers([
	'password' => 'Auth\PasswordController',
]);


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
| Authentication routes. Here we register, login, activate, and logout members
|
*/

/*
 * REGISTER
 */
$router->get('/auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
$router->post('/auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@postRegister']);
/*
 * LOGIN
 */
$router->get('/auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
$router->post('/auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
/*
 * LOGOUT
 */
$router->get('/auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);
/*
 * ACTIVATE
 */
$router->get('auth/activate_user/{token}', ['as' => 'auth.accept.user', 'uses' => 'Auth\ActivateController@getActivation']);
$router->post('auth/activate_user/{token}', ['as' => 'auth.accept.user', 'uses' => 'Auth\ActivateController@postActivation']);





/*
|--------------------------------------------------------------------------
| Tasks
|--------------------------------------------------------------------------
|
|
|
*/

/*
 * ADD TASK
 */
$router->get('task/add', ['as' => 'add.task', 'uses' => 'Tasks\TaskController@create']);
$router->post('task/add', ['as' => 'add.task', 'uses' => 'Tasks\TaskController@store']);
/*
 * UPDATE
 */
$router->post('{project}/{task}/update', ['as' => 'update.task', 'uses' => 'Tasks\TaskController@update']);
$router->get('{project}/{task}/update', ['as' => 'update.task', 'uses' => 'Tasks\TaskController@edit']);
/*
 * DELETE
 */
$router->post('task/delete', ['as' => 'delete.task', 'uses' => 'Tasks\TaskController@destroy']);
/*
 * DENY
 */
$router->post('task/deny', ['as' => 'deny.task', 'uses' => 'Tasks\AssignedTaskController@postDenyTask']);
/*
 * ASSIGNED TASKS
 */
$router->get('{username}/assigned-tasks', ['as' => 'assigned.tasks', 'uses' => 'Tasks\AssignedTaskController@getAssignedTasks']);
/*
 * DETAIL
 */
$router->get('{project}/{task}/detail', ['as' => 'task.detail', 'uses' => 'Tasks\TaskController@show']);
/*
 * ACCEPTANCE
 */
$router->get('{username}/accepted-tasks', ['as' => 'accepted.tasks', 'uses' => 'Tasks\AcceptanceTaskController@getAcceptedTasks']);
$router->post('task/accept-task', ['as' => 'accept.task', 'uses' => 'Tasks\AcceptanceTaskController@postAcceptTask']);
/*
 * STARTING
 */
$router->get('{username}/started-tasks', ['as' => 'started.tasks', 'uses' => 'Tasks\StartedTaskController@getStartedTasks']);
$router->post('task/start-task', ['as' => 'start.task', 'uses' => 'Tasks\StartedTaskController@postStartTask']);
/*
 * COMPLETING
 */
$router->get('{username}/completed-tasks', ['as' => 'completed.tasks', 'uses' => 'Tasks\CompletedTaskController@getCompletedTasks']);
$router->post('task/complete-task', ['as' => 'complete.task', 'uses' => 'Tasks\CompletedTaskController@postCompleteTask']);




/*
|--------------------------------------------------------------------------
| Projects
|--------------------------------------------------------------------------
|
|
|
*/

/*
 * ADD PROJECT
 */
$router->get('project/add', ['as' => 'add.project', 'uses' => 'Projects\ProjectController@create']);
$router->post('project/add', ['as' => 'add.project', 'uses' => 'Projects\ProjectController@store']);
/*
 * SHOW PROJECTS
 */
$router->get('projects', ['as' => 'projects', 'uses' => 'Projects\ProjectController@index']);
/*
 * SHOW ALL TASK BELONGING TO THE PROJECT
 */
$router->get('{project}/tasks', ['as' => 'project.tasks', 'uses' => 'Projects\ProjectTasksController@getAllTasks']);





/*
|--------------------------------------------------------------------------
| Comments
|--------------------------------------------------------------------------
|
| no explanation needed for now
|
*/
$router->post('task/add-comment', ['as' => 'add.task.comment', 'uses' => 'Comments\TaskCommentController@postTaskComment']);

