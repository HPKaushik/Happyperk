@if($data->total() > 0)
<table class="table hover-table table-hover" >
    <thead class="text-primary">
        <tr>
            <th><b>Transaction Id</b></th>
            <th><b>Initial Balance</b></th>
            <th><b>Credited</b></th>
            <th><b>Final Balance</b></th>
            <th><b>Credited On</b></th>
            <th><b>Status</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $key => $tran)
        <tr >
            <td>{{$tran->transaction_code}}</td>
            <td>{{ $tran->begin_balance + 0}}</td>
            <td>{{$tran->credit_amount + 0}}</td>
            <td>{{ $tran->end_balance + 0 }}</td>
            <td>{{ date('d M Y', strtotime($tran->created_at))}} </td>
            <td><span class="label label-{{$tran->status == 'Completed' ? 'success':'danger' }}">{{$tran->status }}</span></td>
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