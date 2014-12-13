<?php namespace TGLD\Members\Events;

use TGLD\Members\Member;

class MemberWasActivated
{
    public $member;

    function __construct(Member $member)
    {
        $this->member = $member;
    }
}