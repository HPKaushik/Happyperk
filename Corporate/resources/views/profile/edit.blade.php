@extends('layouts.app')

@section('page_title')
Manage Profile
@endsection

@section('content')

<div class="container-fluid">
    <div class="col-sm-8 col-sm-offset-2">
        <!--      Wizard container        -->
        <div class="wizard-container">
            <div class="card wizard-card" data-color="purple" id="wizardProfile">
                {!! Form::open(array('route' => ['update-profile'],'method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                <div class="wizard-header">
                    <div class="row">
                        <div class="col-xs-8">
                            <h3 class="wizard-title">
                                Build Your Profile
                            </h3>
                            <h5>This information will let us know more about you.</h5>
                        </div>
                        <div class="col-xs-4">
                            <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                                <button type="submit" class="btn btn-yellow m0">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wizard-navigation">
                    <ul>
                        <li>
                            <a href="#company_about_tab" data-toggle="tab">About</a>
                        </li>
                        <li>
                            <a href="#administrators_tab" data-toggle="tab">Administrators</a>
                        </li>
                        <li>
                            <a href="#bank_account_tab" data-toggle="tab">Bank Account</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="company_about_tab">
                        <div class="row">
                            <h4 class="info-text"> Let's start with the basic information</h4>
                            <div class="col-sm-4 col-sm-offset-1">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="http://demos.creative-tim.com/material-dashboard-pro/assets/img/faces/avatar.jpg" class="picture-src" id="wizardPicturePreview" title="" />
                                        <input type="file" id="wizard-picture">
                                    </div>
                                    <h6>Choose Picture</h6>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!--<div class="input-group">-->
<!--                                        <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>-->
                                <div class="form-group">
                                    <label class="control-label">Company Name
                                        <small>(required)</small>
                                    </label>
                                    <input name="company_name" type="text" value='{{old('company_name',$data->company_name)}}' class="form-control">
                                </div>
                                <!--</div>-->
                                <!--<div class="input-group">-->
<!--                                        <span class="input-group-addon">
                                        <i class="material-icons">record_voice_over</i>
                                    </span>-->
                                <div class="form-group">
                                    <label class="control-label">Company Short Name
                                        <small>(required)</small>
                                    </label>
                                    <input name="short_name" type="text" value='{{old('short_name',isset($data->short_name)?$data->short_name:'')}}' class="form-control">
                                </div>
                                <!--</div>-->
                            </div>
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="col-xs-6">
                                    <!--<div class="input-group">-->
<!--                                            <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>-->
                                    <div class="form-group">
                                        <label class="control-label">Company Established Date
                                            <small>(required)</small>
                                        </label>
                                        <input name="company_established" type="text" value="{{old('company_established',isset($data->company_established) ? date('m/d/Y',strtotime($data->company_established)) : '')}}" class="form-control datepicker">
                                    </div>
                                    <!--</div>-->
                                </div>
                                <div class="col-xs-6">
                                    <!--<div class="input-group">-->
<!--                                            <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>-->
                                    <div class="form-group ">
                                        <label class="control-label">Company Domain
                                            <small>(required)</small>
                                        </label>
                                        <input name="domain" type="text" value="{{old('domain',isset($data->domain)?$data->domain:'')}}" class="form-control">
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="col-xs-6">
                                    <!--<div class="input-group">-->
<!--                                            <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>-->
                                    <div class="form-group">
                                        <label class="control-label">Pan Number
                                            <small>(required)</small>
                                        </label>
                                        <input name="pan_number" type="text" value="{{old('pan_number',isset($data->pan_number)?$data->pan_number:'')}}" class="form-control">
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="col-xs-6">
                                    <!--<div class="input-group">-->
<!--                                            <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>-->
                                    <div class="form-group">
                                        <label class="control-label">Company Address
                                            <small>(required)</small>
                                        </label>
                                        {!! Form::textarea('address', old('address',isset($data->address)?$data->address:''), array('class' => 'form-control','rows'=>'3')) !!}
                                    </div>
                                    <!--</div>-->
                                </div>
                                <div class="col-xs-6">
                                    <!--<div class="input-group">-->
<!--                                            <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>-->
                                    <div class="form-group ">
                                        <label class="control-label">Company Description
                                            <small>(required)</small>
                                        </label>
                                        {!! Form::textarea('description', old('description',isset($data->description)?$data->description:''), array('class' => 'form-control','rows'=>'3')) !!}
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="administrators_tab">
                        <h4 class="info-text"> List of Administrators here? </h4>
                        <!--                            <div class="row">
                                                        <div class="col-lg-10 col-lg-offset-1">
                                                            <div class="col-sm-4">
                                                                <div class="choice" data-toggle="wizard-checkbox">
                                                                    <input type="checkbox" name="jobb" value="Design">
                                                                    <div class="icon">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </div>
                                                                    <h6>Design</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="choice" data-toggle="wizard-checkbox">
                                                                    <input type="checkbox" name="jobb" value="Code">
                                                                    <div class="icon">
                                                                        <i class="fa fa-terminal"></i>
                                                                    </div>
                                                                    <h6>Code</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="choice" data-toggle="wizard-checkbox">
                                                                    <input type="checkbox" name="jobb" value="Develop">
                                                                    <div class="icon">
                                                                        <i class="fa fa-laptop"></i>
                                                                    </div>
                                                                    <h6>Develop</h6>
                                                                </div>
                                                                <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                                                    <option disabled selected>Choose city</option>
                                                                    <option value="2">Foobar</option>
                                                                    <option value="3">Is great</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>-->
                    </div>
                    <div class="tab-pane" id="bank_account_tab">
                        <h4 class="info-text">Add Bank Details</h4>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Account Name:</label>
                                    {!! Form::text('name', old('name',isset($data->bank->name) ? $data->bank->name : ''), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Account Number:</label>
                                    {!! Form::text('account_number', old('account_number',isset($data->bank->account_number) ? $data->bank->account_number : ''), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4"> 
                                <div class="form-group">
                                    <label class="control-label">IFSC Code:</label>
                                    {!! Form::text('ifsc_code', old('ifsc_code',isset($data->bank->ifsc_code) ? $data->bank->ifsc_code : ''), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4"> 
                                <div class="form-group">
                                    <label class="control-label">Bank Name:</label>
                                    {!! Form::text('bank_name', old('bank_name',isset($data->bank->bank_name) ? $data->bank->bank_name : ''), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4"> 
                                <div class="form-group">
                                    <label class="control-label">Branch Name:</label>
                                    {!! Form::text('branch_name', old('branch_name',isset($data->bank->branch_name) ? $data->bank->branch_name : ''), array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        {!! Form::select('state',$_stateslist,old('state',isset($data->bank->state) ? $data->bank->state : ''),array('class'=>'selectpicker','placeholder'=>'Select State','data-style'=>'select-with-transition','data-live-search'=>'true','data-dropup-auto'=>'false')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        {!! Form::select('city',$_citieslist,old('city',isset($data->bank->city) ? $data->bank->city : ''),array('class'=>'selectpicker','placeholder'=>'Select City','data-style'=>'select-with-transition','data-live-search'=>'true','data-dropup-auto'=>'false')) !!}
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <!--                        <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4 class="info-text"> Are you living in a nice area? </h4>
                                                    </div>
                                                    <div class="col-sm-7 col-sm-offset-1">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Street Name</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Street No.</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5 col-sm-offset-1">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">City</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Country</label>
                                                            <select name="country" class="form-control">
                                                                <option disabled="" selected=""></option>
                                                                <option value="Afghanistan"> Afghanistan </option>
                                                                <option value="Albania"> Albania </option>
                                                                <option value="Algeria"> Algeria </option>
                                                                <option value="American Samoa"> American Samoa </option>
                                                                <option value="Andorra"> Andorra </option>
                                                                <option value="Angola"> Angola </option>
                                                                <option value="Anguilla"> Anguilla </option>
                                                                <option value="Antarctica"> Antarctica </option>
                                                                <option value="...">...</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>-->
                    </div>
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                        <!--<input type='button' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Finish' />-->
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
<script type="text/javascript">
    $(document).ready(function () {
        demo.initMaterialWizard();
        demo.initFormExtendedDatetimepickers();
        setTimeout(function () {
            $('.card.wizard-card').addClass('active');
        }, 600);
    });
</script>
@endsection