@extends('layouts.app')

@section('page_title')
Create User
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Create New User</h4>
                    <div class="alert alert-info pull-right" data-notify="container">
                        <a href='{{URL::route('all-users')}}' class="">Back</a>
                    </div>

                </div>
                <div class="card-content">
                    {!! Form::open(array('route' => 'store-user','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            
                            <div class="form-group label-floating">
                                  <label class="control-label">Name:</label>
                                {!! Form::text('name', old('name'), array('placeholder' => '','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group label-floating">
                                 <label class="control-label">Email:</label>
                                {!! Form::text('email', null, array('placeholder' => '','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group label-floating">
                                  <label class="control-label">Password:</label>
                                {!! Form::password('password', array('placeholder' => '','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group label-floating">
                                  <label class="control-label">Confirm Password:</label>
                                {!! Form::password('confirm-password', array('placeholder' => '','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                {!! Form::select('role', $roles,'', array('class' => '','placeholder'=>'Select role')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Create</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
