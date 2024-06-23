@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User Trashed</h1>
    </div>

    {{-- @if (session()->has('success'))
    <div class="alert alert-success col-lg-6" role="alert">
        {{ session('success') }}
    </div>
@endif --}}

    <div class="table-responsive col-lg-6">
        {{-- <a href="/dashboard/users/trashed" class="btn btn-secondary btn-sm mb-3">View Trashed User</a> --}}
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
                @foreach ($trashedUser as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>
                            @if ($item->phone)
                                {{ $item->phone }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="/dashboard/users/restore/{{ $item->slug }}" class="badge bg-info"><span
                                    data-feather="refresh-ccw"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
