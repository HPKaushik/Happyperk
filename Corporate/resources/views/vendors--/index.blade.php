@extends('layouts.app')
@section('page_title')
All Vendors
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Vendors</h4>
                    <div class="alert alert-info pull-right" data-notify="container">
                        Add  vendor
                    </div>
                </div>
                <div class="card-content table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <tr><th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Created On</th>
                            </tr></thead>
                        <tbody>
                            @foreach($vendors as $v)
                            <tr>
                                <td>{{$v->name}}</td>
                                <td>{{$v->email}}</td>
                                <td>{{$v->address}}</td>
                                <td>{{$v->city}}</td>
                                <td>{{$v->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{$vendors->appends(Input::except('page'))}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection