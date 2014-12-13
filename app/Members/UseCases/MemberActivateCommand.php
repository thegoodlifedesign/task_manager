<?php namespace TGLD\Members\UseCases;


class MemberActivateCommand
{
    public  $activate_token;

    function __construct($activate_token)
    {
        $this->activate_token = $activate_token;
    }
}