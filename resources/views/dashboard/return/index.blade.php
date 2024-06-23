@extends('dashboard.layouts.main')

@section('container')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div
        class="col-lg-6 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pengembalian Mobil</h1>
    </div>

    @if (session()->has('message'))
        <div class="alert {{ session('alert-class') }} col-lg-6" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="col-lg-6">
        <form action="rent-return" method="POST" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select class="form-control inputbox @error('user_id') is-invalid @enderror" name="user_id" required>
                    <option value="">-- Select User --</option>
                    @foreach ($users as $user)
                        @if (old('user_id') == $user->id)
                            <option value="{{ $user->id }}" selected>{{ $user->username }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="car_id" class="form-label">Pilih Mobil</label>
                <select class="form-control inputbox @error('car_id') is-invalid @enderror" name="car_id" required>
                    <option value="">-- Pilih Mobil --</option>
                    @foreach ($cars as $car)
                        @if (old('car_id') == $car->id)
                            <option value="{{ $car->id }}" selected>{{ $car->title }}</option>
                        @else
                            <option value="{{ $car->id }}">{{ $car->car_code }} - {{ $car->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.inputbox').select2();
        });
    </script>
@endsection
