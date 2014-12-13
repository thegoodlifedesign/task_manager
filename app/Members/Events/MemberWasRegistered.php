<?php namespace TGLD\Members\Events;

use TGLD\Members\Member;

class MemberWasRegistered
{
    public $member;

    function __construct(Member $member)
    {
        $this->member = $member;
    }
}