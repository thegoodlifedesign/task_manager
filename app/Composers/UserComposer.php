<?php namespace TGLD\Composers;

class UserComposer
{
    protected $memberRepo;

   public function compose($view)
   {
       $view->with('user', 'user');
   }
}