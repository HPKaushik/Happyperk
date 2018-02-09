@if($data->total() > 0)
<table class="table hover-table table-hover" >
    <thead >
        <tr>
            <th><b>Transaction Id</b></th>
            <th><b>Credited To</b></th>
            <th><b>Initial Balance</b></th>
            <th><b>Debited</b></th>
            <th><b>Final Balance</b></th>
            <th><b>Credited On</b></th>
            <th><b>Status</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $data as $key => $t)
        <tr >
            <td>{{$t->transaction_code}}</td>
            <td>{{ $t->first_name}}  {{$t->last_name}} <small>({{$t->emp_code}})</small></td>
            <td >
                {{ $t->begin_balance + 0}}
            </td>
            <td>{{'-'.$t->credit_amount + 0}} </td>
            <td>{{ $t->end_balance + 0}}</td>
            <td>{{ date('d M y H:i:s', strtotime($t->created_at))}} </td>
            <td><span class="label label-{{$t->status == 'Completed' ? 'success':'danger' }}">{{$t->status }}</span></td>
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