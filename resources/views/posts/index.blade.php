@extends('layout.app')

@section('content')
	<div class="row">
		<?php if(count($posts) === 0): ?>
			<p>No posts found...</p>
		<?php else: ?>
			<?php foreach($posts as $post): ?>
				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top"
							 src="posts/{{ $post->image }}"
							 data-holder-rendered="true">
						<div class="card-body">
							<a href="{{ url('/show', ['id' => $post]) }}">
								{{ $post->header }}
							</a>
							<p class="card-text">
								{{ $post->description_short }}
							</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<?php if (Auth::user()): ?>
										<?php if (Auth::user()->can('edit', $post)): ?>
											<a href="{{ url('/edit', ['id' => $post]) }}" type="button" class="btn btn-sm btn-outline-secondary">Edit</a>

											<form action="{{ url('/destroy', ['id' => $post]) }}" method="POST">
												{{ method_field('DELETE') }}
												{{ csrf_field() }}
												<button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
											</form>
										<?php endif ?>
									<?php endif ?>
								</div>
								<span class="small">
									Written by:
									<?php if (Auth::user()): ?>
										<?php if ($post->user->id === Auth::user()->id): ?>
											You
										<?php else: ?>
											{{ $post->user->email }}
										<?php endif; ?>
									<?php else: ?>
										{{ $post->user->email }}
									<?php endif; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
	<div class="row">
		{{ $posts->links("pagination::bootstrap-4") }}
	</div>
@endsection
