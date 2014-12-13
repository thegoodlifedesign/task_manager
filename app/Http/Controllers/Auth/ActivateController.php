<?php namespace TGLD\Http\Controllers\Auth;

use Laracasts\Commander\CommanderTrait;
use TGLD\Http\Controllers\CommandController;
use TGLD\Members\UseCases\MemberActivateCommand;

class ActivateController extends CommandController
{
    use CommanderTrait;

    /**
     * @param $token
     * @return \Illuminate\View\View
     */
    public function getActivation($token)
    {
        return view('auth.activate', compact('token'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postActivation()
    {
        $this->execute(MemberActivateCommand::class);

        return redirect()->route('auth.login');
    }
}