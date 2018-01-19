<h2>3. Suppliers &amp; Service Providers</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Item Name</th>
            <th>Exact Amount</th>
            <th>Paid</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($providers as $provider)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $provider->name }}</td>
                <td>{{ $provider->contact }}</td>
                <td>{{ $provider->item->name }}</td>
                <td>{{ nf($provider->exactAmount) }}</td>
                <td>{{ nf($provider->paid) }}</td>
                <td>{{ nf($provider->balance) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
