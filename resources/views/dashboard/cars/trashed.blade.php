@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Trashed Cars</h1>
    </div>

    <div class="table-responsive col-lg-6">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Code</th>
                    <th scope="col">Nama Mobil</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashed as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->car_code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <a href="/dashboard/cars/restore/{{ $item->slug }}" class="badge bg-info"><span
                                    data-feather="refresh-ccw"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
