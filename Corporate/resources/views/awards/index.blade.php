@extends('layouts.app')
@section('page_title')
All Awards
@endsection

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Awards</h4>
                    <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                        <a href="{{URL::route('create-award')}}" class="btn btn-yellow m0"><i class="material-icons">playlist_add</i>Add Award</a>
                    </div>
                </div>

                <div class="card-content">
                    <div class="fresh-datatables ajax-table" id='_awards_list'>
                        @include('awards.inc.ajax_list')
                    </div> 
                </div> 
            </div>
        </div> 
    </div> 
</div>
@endsection