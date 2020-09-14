<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PostPolicy
 */
class PostPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can edit the model.
	 *
	 * @param  User $user Object
	 * @param  Post $post Object
	 * @return bool
	 */
	public function edit(User $user, Post $post): bool
	{
		return $user->id === $post->user_id;
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  User $user Object
	 * @param  Post $post Object
	 * @return bool
	 */
	public function update(User $user, Post $post): bool
	{
		return $user->id === $post->user_id;
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  User $user Object
	 * @param  Post $post Object
	 * @return bool
	 */
	public function destroy(User $user, Post $post): bool
	{
		return $user->id === $post->user_id;
	}
}
