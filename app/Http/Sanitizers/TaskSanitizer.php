<?php namespace TGLD\Http\Sanitizers;

use TGLD\Utilities\Sanitizer\Sanitizer;

class TaskSanitizer extends Sanitizer
{
    protected $rules = [
        'title' => 'strtolower',
        'description' => 'strtolower',
    ];

} 