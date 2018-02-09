@extends('layouts.app')

@section('page_title')
Add Announcement
@endsection

@section('content')

<div class="container-fluid">
    <div class="col-sm-8 col-sm-offset-2">
        <!--      Wizard container        -->
        <div class="wizard-container">
            <div class="card wizard-card" data-color="purple" id="wizardProfile">
                {!! Form::open(array('route' => ['store-announcement'],'method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                <div class="wizard-header">
                    <div class="row">
                        <div class="col-xs-8">
                            <h3 class="wizard-title">
                                Create An Announcement
                            </h3>
                            <h5>This information will let us know more about you.</h5>
                        </div>
                        <div class="col-xs-4">
                            <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                                <button type="submit" class="btn btn-yellow m0">Create</button>
                            </div>
                            <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                                <a href="{{URL::route('all-announcements')}}" class="btn btn-default m0"><i class="material-icons">keyboard_arrow_left</i>back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wizard-navigation">
                    <ul>
                        <li>
                            <a href="#company_about_tab" data-toggle="tab">Make an Announcement</a>
                        </li>
                        <!--                        <li>
                                                    <a href="#administrators_tab" data-toggle="tab">Administrators</a>
                                                </li>
                                                <li>
                                                    <a href="#bank_account_tab" data-toggle="tab">Bank Account</a>
                                                </li>-->
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
                                        <input type="file" id="wizard-picture" name="image">
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
                                    <label class="control-label">Announcement Name
                                        <small>(required)</small>
                                    </label>
                                    <input name="name" type="text" value='{{old('name')}}' placeholder="enter title here" class="form-control">
                                </div>
                                <!--</div>-->
                                <!--<div class="input-group">-->
<!--                                        <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>-->
                                <div class="form-group">
                                    <label class="control-label">Department
                                        <small>(optional)</small>
                                    </label>
                                    {!! Form::select('department_id',$_departments_list,old('department_id'),array('class'=>'selectpicker','placeholder'=>'Select Department','data-style'=>'select-with-transition','data-live-search'=>'true','data-dropup-auto'=>'false')) !!}
                                </div>
                                <!--</div>-->
                            </div>


                            <div class="col-lg-10 col-lg-offset-1">
                                <!--<div class="input-group">-->
<!--                                            <span class="input-group-addon">
                                        <i class="material-icons">email</i>
                                    </span>-->
                                <div class="form-group">
                                    <label class="control-label">Description
                                        <small>(required)</small>
                                    </label>
                                    {!! Form::textarea('description', old('description'), array('class' => 'form-control','rows'=>'3')) !!}
                                </div>
                                <!--</div>-->
                            </div>

                        </div>
                    </div>
                </div>
                <!--                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                                        <input type='button' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Finish' />
                                    </div>
                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>-->
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
//        demo.initFormExtendedDatetimepickers();
        setTimeout(function () {
            $('.card.wizard-card').addClass('active');
        }, 600);
    });
</script>
@endsection