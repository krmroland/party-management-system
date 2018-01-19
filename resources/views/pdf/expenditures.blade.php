  <h2>4. Expenditures</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($expenditures as $expenditure)
       <tr>
         <td>{{ ++$loop->index }}</td>
         <td>{{ $expenditure->date }}</td>
         <td>{{ nf($expenditure->amount) }}</td>
         <td>{{ $expenditure->description }}</td>
       </tr>
      @endforeach
    </tbody>
  </table>