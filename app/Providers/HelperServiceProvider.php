<?php namespace TGLD\Providers;

use Illuminate\Support\ServiceProvider;
use TGLD\Helpers\TaskFormHelper;
use TGLD\Helpers\TaskHelper;
use TGLD\Helpers\UserHelper;
use TGLD\Members\Repositories\MemberRepository;
use TGLD\Members\Member;
use TGLD\Projects\Project;
use TGLD\Projects\Repositories\ProjectRepository;
use TGLD\Tasks\Repositories\TaskStatisticRepository;
use TGLD\Tasks\TaskStatistic;
use TGLD\Tasks\Repositories\TaskRepository;
use TGLD\Tasks\Task;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->taskHelper();
        $this->userHelper();
        $this->taskFormHelper();
    }

    public function taskHelper()
    {
        $this->app->bind('taskHelpers', function()
        {
            $auth = $this->app->make('Illuminate\Contracts\Auth\Guard');
            return new TaskHelper(new TaskStatisticRepository(new TaskStatistic(), $auth) , $auth);
        });
    }

    public function userHelper()
    {
        $this->app->bind('userHelpers', function(){return new UserHelper;});
    }

    public function taskFormHelper()
    {
        $this->app->bind('taskFormHelpers', function()
        {
            $auth = $this->app->make('Illuminate\Contracts\Auth\Guard');
            return new TaskFormHelper(new ProjectRepository(new Project()), new TaskRepository(new Task(), $auth), new MemberRepository(new Member()), new TaskStatisticRepository(new TaskStatistic(), $auth));
        });
    }
}