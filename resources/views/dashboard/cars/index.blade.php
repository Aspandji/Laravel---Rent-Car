@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cars List</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive col-lg-6">
        <a href="/dashboard/cars/create" class="btn btn-primary btn-sm mb-3">Add New Car</a>
        <a href="/dashboard/cars/trashed" class="btn btn-secondary btn-sm mb-3">View Deleted Data</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Code</th>
                    <th scope="col">Nama Mobil</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $car->car_code }}</td>
                        <td>{{ $car->title }}</td>
                        <td>
                            @foreach ($car->categories as $category)
                                {{ $category->name }},
                            @endforeach
                        </td>
                        <td>{{ $car->status }}</td>
                        <td>
                            {{-- <a href="/dashboard/cars/{{ $car->slug }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a> --}}
                            <a href="/dashboard/cars/{{ $car->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>
                            <form action="/dashboard/cars/{{ $car->slug }}" method="POST" class="d-inline">
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
