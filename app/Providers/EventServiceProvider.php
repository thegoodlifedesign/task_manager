<?php namespace TGLD\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * The classes to scan for event annotations.
	 *
	 * @var array
	 */
	protected $scan = [
		'TGLD\Listeners\Emails\EmailNotifier',
		'TGLD\Listeners\TaskStatistics\TaskStatisticNotifier',
		'TGLD\Listeners\TaskDetails\TaskDetailNotifier',
	];

}
