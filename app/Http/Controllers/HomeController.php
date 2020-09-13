<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

/**
 * Основной контроллер
 */
class HomeController extends BaseController
{
	/**
	 * Главная страница
	 *
	 * @return Response
	 */
	public function index(): Response
	{
		return response()->view('index');
	}

	/**
	 * Аутентификация
	 *
	 * @return Response
	 */
	public function login(): Response
	{
		return response()->view('auth.login');
	}

	/**
	 * Регистрация
	 *
	 * @return Response
	 */
	public function registration(): Response
	{
		return response()->view('auth.register');
	}

	/**
	 * Выход из системы
	 *
	 * @param Request $request Параметры запроса
	 *
	 * @return RedirectResponse
	 */
	public function logout(Request $request): RedirectResponse
	{
		$user = Auth::user();

		if (null !== $user) {
			Auth::logout();
		}

		$request->session()->flash('status', 'Successfully logged out!');

		return response()->redirectTo('/');
	}
}
