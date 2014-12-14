<?php namespace TGLD\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use Laracasts\Commander\CommanderTrait;
use TGLD\Http\Controllers\CommandController;
use TGLD\Http\Requests\Auth\LoginRequest;
use TGLD\Http\Requests\Auth\RegisterRequest;
use TGLD\Members\UseCases\MemberRegisterCommand;
use TGLD\Utilities\Flash\Flash;

class AuthController extends CommandController
{
	use CommanderTrait;

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  Guard  $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Show the application registration form.
	 *
	 * @return Response
	 */
	public function getRegister()
	{
		return view('auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  RegisterRequest  $request
	 * @return Response
	 */
	public function postRegister(RegisterRequest $request)
	{
		$this->execute(MemberRegisterCommand::class, null, [
			'TGLD\Decorators\RegisterFormSanitizer',
			'TGLD\Decorators\UsernameSlugGenerator',
		]);

		return redirect()->back()->with('flash_notification.message','Thank you for register you must now be activated!');
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 *
	 * @param LoginRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(LoginRequest $request)
	{
		$credentials = $request->only('username', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->to('/'.$this->auth->user()->username.'/assigned-tasks');
		}

		Flash::error('Incorrect Credentials');

		return redirect()->back();
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect('/');
	}

}
