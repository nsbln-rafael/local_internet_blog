@extends('layout.app')

@section('content')
    <div class="row text-center">
        <div class="col-md-6 offset-md-4">
            <form class="form" style="max-width: 300px">

                <h1 class="h4 mb-3 font-weight-normal">Login</h1>

                <div class="form-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
                </div>

                <div class="form-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                </div>

                <div class="form-group">
                    <button class="btn btn-lg btn-info btn-block" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
