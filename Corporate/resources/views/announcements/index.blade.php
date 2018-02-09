@extends('layouts.app')
@section('page_title')
All Announcements
@endsection

@section('content')
<div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Announcements</h4>
                     <div class="alert alert-yellow  pull-right" data-notify="container">
                        <a href='{{URL::route('create-announcement')}}' class="">Add Announcement</a> 
                    </div>
                </div>

                <div class="card-content">
                    <div class="ajax-table" id='_anouncement_list'>
                        @include('announcements.inc.ajax_list')
                    </div>
                </div> 
            </div>
        </div>
</div>
@endsection