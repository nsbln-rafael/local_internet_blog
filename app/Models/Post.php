<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Post
 */
class Post extends Model
{
	use HasFactory;

	public const ATTR_HEADER            = 'header';
	public const ATTR_DESCRIPTION_SHORT = 'description_short';
	public const ATTR_DESCRIPTION_FULL  = 'description_full';
	public const ATTR_IMAGE             = 'image';

	/**
	 * The attributes that are mass assignable
	 *
	 * @var array
	 */
	protected $fillable = [
		self::ATTR_HEADER,
		self::ATTR_DESCRIPTION_SHORT,
		self::ATTR_DESCRIPTION_FULL,
		self::ATTR_IMAGE,
	];

	/**
	 * Get the post that owns the comment.
	 *
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo('App\Models\User');
	}
}
