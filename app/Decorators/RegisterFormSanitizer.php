<?php namespace TGLD\Decorators;

use Laracasts\Commander\CommandBus;
use TGLD\Http\Sanitizers\RegisterSanitizer;

class RegisterFormSanitizer implements CommandBus
{
    protected $sanitizer;

    /**
     * @param RegisterSanitizer $sanitizer
     */
    function __construct(RegisterSanitizer $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }


    /**
     * Execute a command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        return $this->sanitizer->sanitize($command);
    }
}