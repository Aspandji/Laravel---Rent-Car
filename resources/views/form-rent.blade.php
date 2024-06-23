@extends('layouts.main')

@section('container')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div
        class="col-lg-6 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Formulir Peminjaman</h1>
    </div>

    @if (session()->has('message'))
        <div class="alert {{ session('alert-class') }} col-lg-6" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="col-lg-6">
        <form action="form-rent" method="POST" class="mb-5">
            @csrf
            <input type="text" value="{{ $user->id }}" name="user_id" hidden>
            <div class="mb-3">
                <label for="name" class="form-label">User</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    placeholder="Username" required autofocus value="{{ $user->username }}" disabled>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="car_id" class="form-label">Pilih Mobil</label>
                <select class="form-control carbox @error('car_id') is-invalid @enderror" name="car_id" required>
                    <option value="">-- Pilih Mobil --</option>
                    @foreach ($cars as $car)
                        @if (old('car_id') == $car->id)
                            <option value="{{ $car->id }}" selected>{{ $car->title }}</option>
                        @else
                            <option value="{{ $car->id }}">{{ $car->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- <div class="mb-3">
                <label for="car" class="form-label">Pilih Mobil</label>
                <input type="datetime-local" class="form-control" name="rent_date">
            </div> --}}

            <div class="mb-3">
                <label for="rent_date" class="form-label">Tanggal Pemesanan</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar3"></i></span>
                    <input type="datetime-local" class="form-control" placeholder="Pilih Tanggal" name="rent_date"
                        aria-describedby="basic-addon1" required>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Booking</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.carbox').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=datetime-local]");
    </script>
@endsection
