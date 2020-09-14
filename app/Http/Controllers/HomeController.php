<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Main controller
 */
class HomeController extends BaseController
{
	/**
	 * Login page
	 *
	 * @param Request $request Params
	 *
	 * @return mixed
	 *
	 * @throws ValidationException
	 */
	public function login(Request $request)
	{
		if ($request->isMethod('post')) {

			$validator = Validator::make($request->post(), [
				User::ATTR_EMAIL    => 'required|email|max:255',
				User::ATTR_PASSWORD => 'required',
			]);

			if ($validator->fails()) {
				return response()->redirectTo('/login')
					->withErrors($validator)
					->withInput();
			}

			$credentials = $validator->validated();

			if (Auth::attempt($credentials)) {
				$request->session()->flash('status', 'Welcome!');

				return response()->redirectTo('/');
			} else {
				$request->session()->flash('error', 'Wrong credentials! Try again.');

				return response()->redirectTo('/login');
			}
		}

		return response()->view('auth.login');
	}

	/**
	 * Registration page
	 *
	 * @param Request $request Params
	 *
	 * @return mixed
	 *
	 * @throws ValidationException
	 */
	public function registration(Request $request)
	{
		if ($request->isMethod('post')) {

			$validator = Validator::make($request->post(), [
				User::ATTR_EMAIL    => 'required|email|unique:users|max:255',
				User::ATTR_PASSWORD => 'required',
			]);

			if ($validator->fails()) {
				return redirect('/registration')
					->withErrors($validator)
					->withInput();
			}

			$credentials    = $validator->validated();
			$user           = new User;
			$user->email    = $credentials[User::ATTR_EMAIL];
			$user->password = Hash::make($credentials[User::ATTR_PASSWORD]);
			$user->save();

			$request->session()->flash('status', 'Successfully registered!');

			return redirect('/login');
		}

		return response()->view('auth.register');
	}

	/**
	 * Logout page
	 *
	 * @param Request $request Params
	 *
	 * @return RedirectResponse
	 */
	public function logout(Request $request): RedirectResponse
	{
		$user = Auth::user();

		if (null !== $user) {
			Auth::logout();

			$request->session()->flash('status', 'Successfully logged out!');
		}

		return response()->redirectTo('/');
	}
}
