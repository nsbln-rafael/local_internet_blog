<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

/**
 * Post controller
 */
class PostController extends Controller
{
	/**
	 * Home page
	 *
	 * @return Response
	 */
	public function index(): Response
	{
		$posts = Post::all();

		return response()->view('posts.index', ['posts' => $posts]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(): Response
	{
		return response()->view('posts.create');
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @param Request $request Params
	 *
	 * @return mixed
	 *
	 * @throws ValidationException
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			Post::ATTR_HEADER            => 'required|max:50',
			Post::ATTR_DESCRIPTION_SHORT => 'required|max:100',
			Post::ATTR_DESCRIPTION_FULL  => 'required|max:255',
			Post::ATTR_IMAGE             => 'required|image|dimensions:min_width=640,min_height=480',
		]);

		if ($validator->fails()) {
			return response()->redirectTo('/create')
				->withErrors($validator)
				->withInput();
		}

		$validated = $validator->validated();
		$post      = new Post($validated);

		$filename  = time() . '.' . $request->image->getClientOriginalExtension();
		$path      = public_path('posts/' . $filename);

		Image::make($request->image->getRealPath())->resize(640, 480)->save($path);

		$post->image = $filename;
		$post->user()->associate(Auth::user());
		$post->save();

		$request->session()->flash('status', 'Post successfully created!');

		return response()->redirectTo('/');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id Post's id
	 * @return Response
	 */
	public function show(int $id): Response
	{
		$post = Post::findOrFail($id);

		return response()->view('posts.show', ['post' => $post]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id Post's id
	 *
	 * @return Response
	 */
	public function edit(int $id): Response
	{
		$post = Post::findOrFail($id);
		Gate::authorize('edit', $post);

		return response()->view('posts.edit', ['post' => $post]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request Params
	 * @param int     $id      Post's id
	 *
	 * @return mixed
	 *
	 * @throws ValidationException
	 */
	public function update(Request $request, int $id)
	{
		$post = Post::findOrFail($id);
		Gate::authorize('update', $post);

		$validator = Validator::make($request->all(), [
			Post::ATTR_HEADER            => 'required|max:50',
			Post::ATTR_DESCRIPTION_SHORT => 'required|max:100',
			Post::ATTR_DESCRIPTION_FULL  => 'required|max:255',
			Post::ATTR_IMAGE             => 'image|dimensions:min_width=640,min_height=480',
		]);

		if ($validator->fails()) {
			return response()->redirectTo('/edit/' . $post->id)
				->withErrors($validator)
				->withInput();
		}

		$validated               = $validator->validated();
		$post->header            = $validated[Post::ATTR_HEADER];
		$post->description_short = $validated[Post::ATTR_DESCRIPTION_SHORT];
		$post->description_full  = $validated[Post::ATTR_DESCRIPTION_FULL];

		if (null !== $request->image) {
			unlink(public_path() . '/posts/' . $post->image);

			$filename  = time() . '.' . $request->image->getClientOriginalExtension();
			$path      = public_path('posts/' . $filename);

			Image::make($request->image->getRealPath())->resize(640, 480)->save($path);

			$post->image = $filename;
		}

		$post->save();

		$request->session()->flash('status', 'Post successfully updated!');

		return response()->redirectTo('/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int     $id      Post's id
	 * @param Request $request Params
	 *
	 * @return RedirectResponse
	 */
	public function destroy(int $id, Request $request): RedirectResponse
	{
		$post = Post::findOrFail($id);
		Gate::authorize('destroy', $post);
		$post->delete();

		unlink(public_path() . '/posts/' . $post->image);

		$request->session()->flash('status', 'Post successfully deleted!');

		return response()->redirectTo('/');
	}
}
