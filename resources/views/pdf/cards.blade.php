<h2>5. Distributed Cards</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Issued On</th>
            <th>Name</th>
            <th>Issued By</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cards as $card)
        <tr>
            <td>{{ ++$loop->index }}</td>
            <td>{{ $card->issued_on }}</td>
            <td>{{ $card->fullName }}</td>
            <td>{{ $card->issued_by }}</td>
        </tr>
        @endforeach
       
    </tbody>
</table>
