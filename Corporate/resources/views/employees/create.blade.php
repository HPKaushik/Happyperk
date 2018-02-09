@extends('layouts.app')

@section('page_title')
Add Employee
@endsection

@section('content')
<div class="container-fluid">
    <div class="col-sm-10 col-sm-offset-1">
        <!--      Wizard container        -->
        <div class="wizard-container">
            <div class="card wizard-card" data-color="purple" id="wizardProfile">
                {!! Form::open(array('route' => ['store-employee'],'method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                <div class="wizard-header">
                    <div class="row">
                        <div class="col-xs-8">
                            <h3 class="wizard-title">
                                Add Employee
                            </h3>
                            <h5>This information will let us know more about you.</h5>
                        </div>
                        <div class="col-xs-4">
                            <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                                <button type='submit' class="btn btn-yellow m0"><i class="material-icons">save</i>Create</button>
                            </div>
                            <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                                <a href="{{URL::route('all-employees')}}" class="btn btn-default m0"><i class="material-icons">keyboard_arrow_left</i>back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wizard-navigation">
                    <ul>
                        <li>
                            <a href="#emp_personal_tab" data-toggle="tab">Personal Details</a>
                        </li>
                        <li>
                            <a href="#emp_profe_tab" data-toggle="tab">Professional Details</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="emp_personal_tab">
                        <h4 class="info-text"> Add Personal Details</h4>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Email <small>(required)</small></label>
                                    {!! Form::text('email', old('email'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Phone Number <small>(required)</small></label>
                                    {!! Form::text('phone',old('phone'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4"> 
                                <div class="form-group">
                                    <label class="control-label">First Name <small>(required)</small></label>
                                    {!! Form::text('first_name',old('first_name'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4"> 
                                <div class="form-group">
                                    <label class="control-label">Last Name <small>(required)</small></label>
                                    {!! Form::text('last_name', old('last_name'),array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4"> 
                                <div class="form-group">
                                    <label class="control-label">DOB</label>
                                    {!! Form::text('date_of_birth', old('date_of_birth'),array('class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="emp_profe_tab">
                        <h4 class="info-text"> Add Professional Details</h4>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Employee Code <small>(required)</small></label>
                                    {!! Form::text('employee_code',old('employee_code'), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Date Of Joining <small>(required)</small></label>
                                    {!! Form::text('joining_date', old('joining_date'), array('class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Department <small>(required)</small></label>
                                    {!! Form::select('department',$_departments_list,old('department'),array('class'=>'selectpicker','placeholder'=>'Select Department','data-style'=>'select-with-transition','data-live-search'=>'true','data-dropup-auto'=>'false')) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Company Location <small>(required)</small></label>
                                    {!! Form::select('location',$_locations_list,old('location'),array('class'=>'selectpicker','placeholder'=>'Select Location','data-style'=>'select-with-transition','data-dropup-auto'=>'false')) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Designations<small>(required)</small></label>
                                    {!! Form::select('designation',$_designations_list,old('designation'),array('class'=>'selectpicker','placeholder'=>'Select Designation','data-style'=>'select-with-transition','data-dropup-auto'=>'false')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                        <!--<input type='submit' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Finish' />-->
                    </div>
                    <div class="pull-left">
                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                    </div>
                    <div class="clearfix"></div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- wizard container -->
    </div>
</div>
@endsection
@section('component_specific_js')
<script type="text/javascript" src="{{asset('js/awards/index.js')}}"></script>
<script type="text/javascript">
$(function () {
    demo.initFormExtendedDatetimepickers();
});
</script>
@endsection