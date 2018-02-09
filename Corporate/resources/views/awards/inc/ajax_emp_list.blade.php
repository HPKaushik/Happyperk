@if($data->employees->total() > 0)
<table class="table hover-table table-hover" >
    <thead >
        <tr>
            <th><b>Select</b></th>
            <th><b>Emp Code</b></th>
            <th><b>Name</b></th>
            <th><b>Department</b></th>
            <th><b>Created On</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->employees as $key => $emp)
        <tr>
            <td>
                <div class="radio">
                    <label>
                        <input type="radio" name="employee" class="move_on_select" value="{{$emp->employee_id}}"
                               @isset($data->award)
                               {{$emp->employee_id == $data->award->employee ? 'checked':''}}
                               @endif
                               ><span class="circle"></span><span class="check"></span>
                    </label>
                </div>
            </td>
            <td >
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
    {{$data->employees->appends(Input::except('page'))}}
</div>
@else
<p class="category text-center m50">No Data Found</p>
@endif