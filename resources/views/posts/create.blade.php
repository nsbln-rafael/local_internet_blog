@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="h4 mb-3 font-weight-normal">Add a post</h1>
            <div>
                <form method="post" action="{{ url('/store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="header">Header</label>
                        <input value="{{ old('header') ? old('header') : '' }}" name="header" type="text" class="form-control"/>
                        <span class="small error text-danger">{{ $errors->first('header') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="description_short">Description short</label>
                        <textarea class="form-control" name="description_short">{{ old('description_short') ? old('description_short') : '' }}</textarea>
                        <span class="small error text-danger">{{ $errors->first('description_short') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="description_full">Description full</label>
                        <textarea class="form-control" name="description_full">{{ old('description_full') ? old('description_full') : '' }}</textarea>
                        <span class="small error text-danger">{{ $errors->first('description_full') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="header">Image</label>
                        <input type="file" class="form-control" name="image"/>
                        <span class="small error text-danger">{{ $errors->first('image') }}</span>
                    </div>

                    <button type="submit" class="btn btn-primary">Add post</button>
                </form>
            </div>
        </div>
    </div>
@endsection

