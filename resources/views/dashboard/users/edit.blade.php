@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/users/{{ $user->slug }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-floating">
                <input type="text" class="form-control rounded-top @error('username') is-invalid @enderror" name="username"
                    id="username" placeholder="Jhon Doe" autofocus required value="{{ old('username', $user->username) }}">
                <label for="username">Username</label>
                @error('username')
                    <div id="username" class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control rounded-top @error('password') is-invalid @enderror"
                    name="password" id="password" placeholder="Password">
                <label for="password">Password</label>
                @error('password')
                    <div id="password" class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="number" class="form-control rounded-top @error('phone') is-invalid @enderror" name="phone"
                    id="phone" placeholder="0821346758" value="{{ old('phone', $user->phone) }}">
                <label for="phone">Phone</label>
                @error('phone')
                    <div id="phone" class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <textarea class="form-control rounded-top @error('address') is-invalid @enderror" name="address" id="address"
                    placeholder="Jl. Semoga Berkah" style="height: 100px" required value="{{ old('address') }}">{{ $user->address }}</textarea>
                <label for="address">Alamat</label>
                @error('address')
                    <div id="address" class="invalid-tooltip">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if ($user->status == 'inactive')
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="active" name="status" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Actived User
                    </label>
                </div>
            @else
                <div class="form-check mt-3 d-none">
                    <input class="form-check-input" type="checkbox" value={{ $user->status }} name="status"
                        id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        {{ $user->status }}
                    </label>
                </div>
            @endif

            <button class="mt-3 btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
