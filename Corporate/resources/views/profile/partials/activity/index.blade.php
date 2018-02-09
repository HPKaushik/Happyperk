@extends('layouts.app')

@section('page_title')
Create User
@endsection

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Logs</h4>
                </div>
              
                <div class="card-content">
                    <div class="fresh-datatables ajax-table" id='anouncement_list'>
                        @include('profile.partials.activity.ajax_list')
                    </div> 
                </div> 
            </div>
        </div> 
    </div> 
</div>

@endsection