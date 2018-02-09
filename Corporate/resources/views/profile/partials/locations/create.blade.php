@extends('layouts.app')

@section('page_title')
Add Company Location
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Create New Location</h4>
                    <div class="alert alert-yellow pull-right" data-notify="container">
                        <a href='{{URL::route('all-company-locations')}}' class=""><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                <div class="card-content">
                    {!! Form::open(array('route' => 'store-company-location','method'=>'POST','class'=>'hp-validate-form','novalidate'=>'novalidate')) !!}
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Name (required)</label>
                                {!! Form::text('location_name', old('location_name'), array('class' => 'form-control','required'=>'true')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">State (required)</label>
                                {!! Form::select('state',$_stateslist,old('state'), array('class' => 'selectpicker','data-live-search'=>'true','data-style'=>'select-with-transition')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label class="control-label">City (required)</label>
                                {!! Form::select('city',$_citieslist,old('city'), array('class' => 'selectpicker','data-live-search'=>'true','data-style'=>'select-with-transition')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Pincode (required)</label>
                                {!! Form::text('pincode', old('pincode'), array('class' => 'form-control','required'=>'true')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                {!! Form::textarea('address', old('address'), array('class' => 'form-control','rows'=>'3')) !!}
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Contact Details <b class="caret"></b></legend>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Email (required)</label>
                                    {!! Form::text('email', old('email'), array('class' => 'form-control','required'=>'true')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Primary Contact (required)</label>
                                     {!! Form::text('primary_contact', old('primary_contact'), array('class' => 'form-control','required'=>'true')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Telephone (required)</label>
                                    {!! Form::text('telephone', old('telephone'), array('class' => 'form-control','required'=>'true')) !!}
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-yellow">Create</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
