@extends('layouts.app')
@section('page_title')
All Employees
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="heade-title text-center">All Employees</h4>
                    <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                        <a href="{{URL::route('create-employee')}}" class="btn btn-yellow m0"><i class="material-icons">playlist_add</i>Add Employee</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-3">
                                <div class="form-group m0">
                                    <label class="control-label text-white m0">Employee Code</label>
                                    <input name="emp_code" id='_emp_code_search' type="text" class="form-control text-white" value="{{app('request')->input('emp_code')}}" placeholder="search by employee code" onclick="this.select();">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group m0">
                                    <label class="control-label text-white m0">Employee Name</label>
                                    <input name="name" type="text" id='_emp_name_search' class="form-control text-white" value="{{app('request')->input('name')}}" placeholder="search by employee name"  onclick="this.select();">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group m0">
                                    <label class="control-label text-white m0">Employee Department</label>
                                    {!! Form::select('department',$_departments_list,app('request')->input('department'),array('id'=>'_emp_dep_search','class'=>'selectpicker text-white','placeholder'=>'Select Department','data-style'=>'select-with-transition','data-live-search'=>'true','data-dropup-auto'=>'false')) !!}
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-success btn-round" onclick="searchEmployees('{{URL::route("all-employees")}}','_employee_list');">Search</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-content">
                    <div class="fresh-datatables ajax-table" id='_employee_list'>
                        @include('employees.inc.ajax_emp_list')
                    </div> 
                </div> 
            </div>
        </div> 
    </div> 
</div>
@endsection
@section('component_specific_js')
<script type="text/javascript" src="{{asset('js/awards/index.js')}}"></script>
@endsection