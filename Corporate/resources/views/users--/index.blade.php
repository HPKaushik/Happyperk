@extends('layouts.app')

@section('page_title')
Manage Users
@endsection

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Users</h4>
                    <div class="alert alert-info pull-right" data-notify="container">
                        <a href='{{URL::route('create-user')}}' class="">Add  User</a> 
                    </div>
                </div>
                <div class="card-content">
                    <div class="fresh-datatables">
                        <table class="table responsive-table" >
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div> 
                
                </div> </div> </div> </div> </div>

@endsection    
