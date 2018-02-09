@extends('layouts.app')

@section('page_title')
Company Departments
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Company Departments</h4>
                    <div class="alert alert-yellow  pull-right" data-notify="container">
                        <a href='{{URL::route('create-company-department')}}' class="">Add Department</a> 
                    </div>
                </div>
                <div class="card-content">
                    <div class="fresh-datatables ajax-table" id='corporate_list'>
                        @if($data->total() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $dep)
                                <tr>
                                    <td><a href="{{URL::route('edit-company-department',$dep->id)}}">Edit</a></td>
                                    <td>{{$dep->department_name}}</td>
                                    <td>{{$dep->department_description}}</td>
                                </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                        {{$data->appends(Input::except('page'))}}
                        @else
                        <p class="category">No data Found</p>
                        @endif
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>


@endsection
