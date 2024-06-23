<div>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">User</th>
                <th scope="col">Mobil</th>
                <th scope="col">Rent Date</th>
                <th scope="col">Return Date</th>
                <th scope="col">Actual Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlog as $item)
                <tr
                    class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'bg-danger' : 'bg-success') }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->car->title }}</td>
                    <td>{{ $item->rent_date }}</td>
                    <td>{{ $item->return_date }}</td>
                    <td>{{ $item->actual_return_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
