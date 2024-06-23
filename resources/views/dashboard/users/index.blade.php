@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List Penyewa</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-6">
        <a href="/dashboard/users/trashed" class="btn btn-secondary btn-sm mb-3">View Trashed Data</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @if ($user->phone)
                                {{ $user->phone }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <a href="/dashboard/users/{{ $user->slug }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>
                            <a href="/dashboard/users/{{ $user->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/users/{{ $user->slug }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><span
                                        data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
