@extends('dashboard.layouts.main')

@section('container')
    <div
        class="col-lg-8 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Penyewa</h1>
    </div>

    <div class="col-lg-8">
        <form action="#" method="" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Username</label>
                <input type="text" class="form-control" readonly value="{{ $user->username }}" />
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Phone</label>
                <input type="text" class="form-control" readonly value="{{ $user->phone }}" />
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" style="height: 100px" readonly>{{ $user->address }}</textarea>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Riwayat Sewa</h1>
    </div>

    <div>
        <x-rent-log-table :rentlog='$rent_logs' />
    </div>
@endsection
