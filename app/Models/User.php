<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Класс пользователя
 */
class User extends Authenticatable
{
	use HasFactory, Notifiable;

	/**
	 * Основные атрибуты.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email', 'password',
	];

	/**
	 * Скрытые для массивов атрибуты
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Атрибуты, которые следует приводить к собственным типам
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}
