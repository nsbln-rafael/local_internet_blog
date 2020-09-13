@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-4">
            <form class="form" style="max-width: 300px" method="post">
                @csrf
                <h1 class="h4 mb-3 font-weight-normal">Login</h1>

                <div class="form-group">
                    <input name="email" value="{{ old('email') ? old('email') : '' }}" type="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus="">
                    <span class="small error text-danger">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group">
                    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password">
                    <span class="small error text-danger">{{ $errors->first('password') }}</span>
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-info btn-block" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
