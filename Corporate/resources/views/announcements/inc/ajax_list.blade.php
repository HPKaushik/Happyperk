@if($data->total() > 0)
<table class="table hover-table table-hover" >
    <thead >
        <tr>
            <th>Actions</th>
            <th>Announcement Id</th>
            <th>Announcement Name</th>
            <th>Description</th>
            <th>Added On</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $key => $anno)
        <tr>
            <td><a href="{{URL::route('edit-announcement',$anno->id)}}">Edit</a></td>
            <td>{{ $anno->announcement_id}} </td>
            <td > {{ $anno->name }}</td>
            <td>{{ $anno->description }}</td>
            <td>{{ date('d M Y',strtotime($anno->created_at))}}</td>
            <td><span class="label label-{{$anno->status == 0 ? 'danger':'success' }}">{{$anno->status == 0 ? 'InActive': 'Active'}}</span></td>
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