<?php namespace TGLD\Utilities\Sanitizer;

abstract class Sanitizer
{
    protected $rules;

    public function sanitize($command)
    {
        foreach($this->rules as $key => $value)
        {
            $rules = explode('|', $value);

            $field = $command->$key;

            if($command->$key != null)
            {
                foreach($rules as $rule)
                {
                    $field = call_user_func($rule, $field);
                }
            }
            else
            {
                throw new \Exception;
            }

            $command->$key = $field;
        }

        return $command;
    }


} 