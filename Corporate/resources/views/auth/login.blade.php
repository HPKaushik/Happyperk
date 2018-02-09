@extends('layouts.auth_app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">login</h4>
                    <p class="category">Complete your profile</p>
                </div>
                <div class="card-content">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">User Email</label>

                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Login</button>
                        <div class="clearfix"></div>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
