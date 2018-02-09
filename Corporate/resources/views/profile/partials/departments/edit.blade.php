@extends('layouts.app')

@section('page_title')
Edit Department
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Update Department</h4>
                    <div class="alert alert-yellow pull-right" data-notify="container">
                        <a href='{{URL::route('all-company-departments')}}' class=""><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="card-content">
                    {!! Form::open(array('route' => ['update-company-department',$data->id],'method'=>'POST','class'=>'hp-validate-form','novalidate'=>'novalidate')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <label class="control-label">Name (required)</label>
                                {!! Form::text('department_name', old('department_name',$data->department_name), array('class' => 'form-control','required'=>'true')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <label class="control-label">Description (required)</label>
                                {!! Form::textarea('department_description', old('department_description',$data->department_description), array('class' => 'form-control','required'=>'true','rows'=>'3')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-yellow">Update</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
