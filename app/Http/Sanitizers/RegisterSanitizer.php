<?php namespace TGLD\Http\Sanitizers;

use TGLD\Utilities\Sanitizer\Sanitizer;

class RegisterSanitizer extends Sanitizer
{
     protected $rules = [
        'username' => 'trim|strtolower',
        'email' => 'strtolower',
        'first_name' => 'strtolower',
        'last_name' => 'strtolower',
    ];

} 