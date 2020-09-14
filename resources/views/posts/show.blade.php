@extends('layout.app')

@section('content')
	<div class="col-md-4">
		<div class="card mb-4 box-shadow">
			<img class="card-img-top"
			     src="../posts/{{ $post->image }}"
			     data-holder-rendered="true">
			<div class="card-body">
				<p>
					{{ $post->header }}
				</p>
				<p class="card-text">
					{{ $post->description_short }}
				</p>
				<p class="card-text">
					{{ $post->description_full }}
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

						<a href="{{ url('/')}}" type="button" class="btn btn-sm btn-outline-secondary">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
