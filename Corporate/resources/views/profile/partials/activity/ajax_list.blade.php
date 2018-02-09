@if($data->total() > 0)
<table class="table hover-table table-hover" >
    <thead >
        <tr>
            <th>User</th>
            <th>Operation</th>
            <th>On</th>
            <th>At</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $key => $l)
        <tr >
            <td>{{ $l->module}}
            </td>
            <td >
            <span class="label label-{{$l->operation == 'Deleted' ? 'danger':'success' }}">{{$l->operation}}</span>
              
            </td>
            <td>{{ date('d M Y ',strtotime($l->created_at)) }}</td>
            <td>{{ date('h:i:s a ',strtotime($l->created_at)) }} &nbsp&nbsp<span style="color: gray">{{ \Carbon\Carbon::parse($l->created_at)->diffForHumans() }}</span></td>
        
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

