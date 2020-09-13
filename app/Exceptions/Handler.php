<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

/**
 * Class Handler
 */
class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * {@inheritdoc}
	 *
	 * @throws Throwable
	 */
	public function render($request, Throwable $exception)
	{
		if ($exception instanceof RouteNotFoundException) {
			$request->session()->flash('error', 'Action is not allowed!');

			return redirect('/');
		}

		return parent::render($request, $exception);
	}
}
