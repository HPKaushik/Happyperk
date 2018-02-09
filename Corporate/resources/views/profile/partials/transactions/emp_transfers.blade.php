@extends('layouts.app')
@section('page_title')
All Employee Transfers
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Employee Transfers</h4>
                    <div class="alert alert-yellow pull-right m0 p0" data-notify="container">
                        <a href="#" class="btn btn-yellow m0"><i class="material-icons">swap_horiz</i>Send Money</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="fresh-datatables ajax-table" id='emp_transfers_list'>
                        @include('profile.partials.transactions.ajax_emp_list')
                    </div> 
                </div> 
            </div>
        </div> 
    </div> 
</div>
@endsection