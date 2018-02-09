@extends('layouts.app')
@section('page_title')
Add Designations
@endsection

@section('content')
<div class="container-fluid designation_company">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Designations</h4>
                    <p class="category">Drag and drop designations from the below list</p>
                </div>
                <div class="card-content">
                    <ul class="nav drag-here" id="_all_designations_list" ondrop="drop(event)" >
                        @foreach($data as $desig)
                        <li draggable="true" ondragstart="drag(event)" id='pre_design_{{$desig->id}}'>
                            <input type="hidden" name="designations[]" value="{{$desig->id}}"/>
                            {{$desig->name}}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {!! Form::open(array('route' => ['store-designation'],'method'=>'POST')) !!}
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Company Designation</h4>
                    <div class="alert alert-yellow  pull-right p0" data-notify="container">
                        <button type="submit" class="btn btn-yellow m0"><i class="material-icons">save</i>Save</button>
                    </div>
                </div>
                <div class="card-content">
                    <ul id="_company_designation_list" class="nav drop-here" ondragover="allowDrop(event)" ondrop="drop(event)">
                        @foreach($data->company_designations as $cdesig)
                        <li draggable="true" ondragstart="drag(event)" id='pre_design_{{$cdesig->id}}'>
                            <input type="hidden" name="designations[]" value="{{$cdesig->id}}"/>
                            {{$cdesig->name}}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('component_specific_js')
<script type="text/javascript" src="{{asset('js/designations/index.js')}}"></script>
@endsection