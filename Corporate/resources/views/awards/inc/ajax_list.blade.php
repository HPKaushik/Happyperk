@if($data->total() > 0)
<table class="table hover-table table-hover" >
    <thead >
        <tr>
            <th><b>Id</b></th>
            <th><b>Award</b></th>
            <th><b>To</b></th>
            <th><b>Description</b></th>
            <th><b>On</b></th>
            <th><b>Status</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $key => $a)
        <tr>
            <td><a href="{{URL::route('edit-award',$a->id)}}">Edit</a>
            </td>
            <td >
                {{ $a->title }}
            </td>
            <td>{{$a->first_name}}  {{$a->last_name}}</td>
            <td>{{ $a->description }}</td>
            <td>{{ date('d M y', strtotime($a->created_at))}}</td>
            <td><span class="label label-{{$a->status == 0 ? 'danger':'success' }}">{{$a->status == 0 ? 'InActive': 'Active'}}</span></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{$data->appends(Input::except('page'))}}
</div>
@else
<p class="category">No Data Found</p>
@endif