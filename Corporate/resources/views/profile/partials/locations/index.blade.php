@extends('layouts.app')

@section('page_title')
Company Locations
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">All Company Locations {{$data->total()}}</h4>
                    <div class="alert alert-yellow  pull-right" data-notify="container">
                        <a href='{{URL::route('create-company-location')}}' class="">Add Location</a> 
                    </div>
                </div>
                <div class="card-content">
                    <div class="fresh-datatables ajax-table" id='corporate_list'>
                        @if($data->total() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Location Name</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $loc)
                                <tr>
                                    <td><a href="{{URL::route('edit-company-location',$loc->id)}}">Edit</a></td>
                                    <td>{{$loc->location_name}}</td>
                                    <td>{{$loc->email}}</td>
                                    <td>{{$loc->telephone}}</td>
                                    <td>{{$loc->address}}</td>
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
