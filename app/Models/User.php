<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * User class
 */
class User extends Authenticatable
{
	use HasFactory, Notifiable;

	public const ATTR_EMAIL    = 'email';
	public const ATTR_PASSWORD = 'password';

	/**
	 * The attributes that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = [
		self::ATTR_EMAIL,
		self::ATTR_PASSWORD,
	];

	/**
	 * The attributes that should be hidden for arrays
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
}
