@extends('layouts.app')

@section('page_title')
Edit Award
@endsection

@section('content')

<div class="container-fluid">
    <div class="col-sm-10 col-sm-offset-1">
        <!--      Wizard container        -->
        <div class="wizard-container">
            <div class="card wizard-card" data-color="purple" id="wizardProfile">
                {!! Form::open(array('route' => ['update-award',$data->award->id],'method'=>'POST','enctype'=>'multipart/form-data')) !!}
                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                <div class="wizard-header">
                    <div class="row">
                        <div class="col-xs-8">
                            <h3 class="wizard-title">
                                Awards
                            </h3>
                            <h5>This information will let us know more about you.</h5>
                        </div>
                        <div class="col-xs-4">
                            <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                                <a href="{{URL::route('all-awards')}}" class="btn btn-default m0"><i class="material-icons">keyboard_arrow_left</i>back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wizard-navigation">
                    <ul>

                        <li>
                            <a href="#choose_badge_tab" data-toggle="tab">Badges</a>
                        </li>
                        <li>
                            <a href="#about_award_tab" data-toggle="tab">About Award</a>
                        </li>
                        <li>
                            <a href="#choose_employee_tab" data-toggle="tab">Awarded Employee</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">

                    <div class="tab-pane" id="choose_badge_tab">
                        <h4 class="info-text"> Lets start by choosing a badge </h4>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                @foreach($data as $badge)
                                <div class="col-sm-3">
                                    <div class="choice text-center move_on_select {{ $badge->id == $data->award->badge_id ? 'active': ''}}" data-toggle="wizard-radio">
                                        <input type="radio" name="badge" value="{{$badge->id}}" {{ $badge->id == $data->award->badge_id ? 'checked': ''}}>
                                        <!--                                        <div class="icon">-->
                                        <img src="{{asset('storage/'.$badge->image)}}" alt="{{$badge->title}}" class="img-thumbnail icon m0"/>
                                        <!--</div>-->
                                        <h6>{{$badge->title}}</h6>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="about_award_tab">
                        <h4 class="info-text"> Let your employee know why he's best among all</h4>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">subtitles</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Award Title
                                            <small>(required)</small>
                                        </label>
                                        <input name="title" type="text" value='{{old('title',$data->award->title)}}' class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">description</i>
                                    </span>
                                    <div class="form-group">
                                        <label class="control-label">Description
                                            <small>(required)</small>
                                        </label>
                                        {!! Form::textarea('description', old('description',$data->award->description), array('class' => 'form-control','rows'=>'3','placeholder'=>'say something about the award')) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="choose_employee_tab">
                        <br>
                        <div class="fresh-datatables ajax-table" id='ajax_emp_list'>
                            @include('awards.inc.ajax_emp_list')
                        </div>
                    </div>
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <input type='button' class='btn btn-next btn-fill btn-rose btn-wd' name='next' value='Next' />
                        <input type='submit' class='btn btn-finish btn-fill btn-rose btn-wd' name='finish' value='Finish' />
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
@endsection