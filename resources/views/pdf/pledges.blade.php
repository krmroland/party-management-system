
<h2>2. Contributions</h2>
<table>
    <thead>
        <tr>
          <th>#</th>
          <th>Date</th>
          <th>Name</th>  
          <th>Pledged</th>
          <th>Paid</th>
          <th>Balance</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($pledges['items'] as $pledge)
    <tr>
        <td>{{ ++$loop->index}}</td>
        <td>{{ $pledge->date}}</td>
        <td>{{ $pledge->name}}</td>
        <td>{{ $pledge->rawPledged}}</td>
        <td>{{ $pledge->rawPaid}}</td>
        <td>{{ $pledge->rawBalance}}</td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
    <th colspan="3">Totals</th>
    <th>{{ nf($pledges['pledgedTotal'])}} /=</th>
    <th>{{ nf($pledges['paidTotal'])}} /=</th>
    <th>
     {{ nf($pledges['balanceTotal'])}} /=
    </th>
    </tr>
</tfoot>
</table>
