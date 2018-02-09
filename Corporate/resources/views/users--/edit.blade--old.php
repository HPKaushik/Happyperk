@extends('layouts.app')

@section('htmlheader_title')
    Edit User
@endsection

@section('main-content')
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="content">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->

                                    <div class="pull-right">
                                        <a class="btn btn-wd btn-default" href="{{ route('users.list') }}">  <span
                                                    class="btn-label">
                                                <i class="fa fa-arrow-left"></i>
                                            </span> Back</a>

                                    </div>
                                </div>

                                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}

                                <div class="header">
                                    <h4 class="title">Edit User</h4>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Email:</label>
                                                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Password:</label>
                                                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Confirm Password:</label>
                                                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Role:</label>
                                                {!! Form::select('roles[]', $roles, $userRole, array('class' => 'selectpicker', 'data-dropup-auto'=>'false','data-style'=> 'btn-info btn-fill btn-block', 'data-menu-style' => 'dropdown-blue', 'data-title' => 'Multiple Select')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="submit" class="btn btn-info btn-fill pull-right">Submit</button>
                                    </div>
                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection