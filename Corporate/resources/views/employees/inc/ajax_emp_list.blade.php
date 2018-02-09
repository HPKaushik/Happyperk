@if($data->total() > 0)
<table class="table hover-table table-hover" >
    <thead >
        <tr>
            <th><b>Actions</b></th>
            <th><b>Emp Code</b></th>
            <th><b>Name</b></th>
            <th><b>Department</b></th>
            <th><b>Created On</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $emp)
        <tr>
            <td>
                <a href="{{URL::route('edit-employee',$emp->employee_id)}}">Edit</a>
            </td>
            <td>
                {{ $emp->emp_code ? $emp->emp_code : '-' }}
            </td>
            <td>{{$emp->first_name}}  {{$emp->last_name}}</td>
            <td>{{ $emp->department_name }}</td>
            <td>{{ date('d M y', strtotime($emp->created_at))}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{$data->appends(Input::except('page'))}}
</div>
@else
<p class="category text-center m50">No Data Found</p>
@endif