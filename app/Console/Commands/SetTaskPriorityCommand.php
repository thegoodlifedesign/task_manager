<?php namespace TGLD\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use TGLD\Support\TaskPriority\TaskPriorityGenerator;

class SetTaskPriorityCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'task:set-priority';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Set the priority for the tasks';

	protected $priorityGenerator;

	function __construct(TaskPriorityGenerator $priorityGenerator)
	{
		parent::__construct();

		$this->priorityGenerator = $priorityGenerator;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->priorityGenerator->setAllPriorities();
	}

}
