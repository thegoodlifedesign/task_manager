<?php namespace TGLD\Members\UseCases;

class MemberRegisterCommand
{
    public $email;

    public $first_name;

    public $last_name;

    public $password;

    public $username;

    function __construct($email, $first_name, $last_name, $password, $username)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }
}