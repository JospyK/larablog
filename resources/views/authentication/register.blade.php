@extends('main')

@section("pagetitle", " Register")

@section("stylesheets")

@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="fname" class="col-md-3 control-label">First Name</label>

                            <div class="col-md-8">
                                <input id="fname" type="text" class="form-control" name="first_name" value="{{ old('fname') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lname" class="col-md-3 control-label">Last Name</label>

                            <div class="col-md-8">
                                <input id="lname" type="text" class="form-control" name="last_name" value="{{ old('lname') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="classe" class="col-md-3 control-label">Classe</label>

                            <div class="col-md-8">
                                <input id="classe" type="text" class="form-control" name="classe" value="{{ old('classe') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
