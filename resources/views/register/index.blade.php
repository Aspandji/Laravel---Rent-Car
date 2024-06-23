@extends('layouts.main')

@section('container')
<div class="row d-flex justify-content-center">
    <div class="col-lg-4">
        <main class="form-signin w-100 m-auto">
          @if (session('status'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>                
          @endif
            <h1 class="h3 mb-3 fw-normal text-center">Register Account</h1>
            <form action="" method="POST">
              @csrf
              <div class="form-floating">
                <input type="text" class="form-control rounded-top @error('username') is-invalid @enderror" name="username" id="username" placeholder="Jhon Doe" autofocus required value="{{ old('username') }}">
                <label for="username">Username</label>
                @error('username')
                  <div id="username" class="invalid-tooltip">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" class="form-control rounded-top @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                  <div id="password" class="invalid-tooltip">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="number" class="form-control rounded-top @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="0821346758" value="{{ old('phone') }}">
                <label for="phone">Phone</label>
                @error('phone')
                  <div id="phone" class="invalid-tooltip">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <textarea class="form-control rounded-top @error('address') is-invalid @enderror" name="address" id="address" placeholder="Jl. Semoga Berkah" style="height: 100px" required value="{{ old('address') }}"></textarea>
                <label for="address">Alamat</label>
                @error('address')
                  <div id="address" class="invalid-tooltip">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit">Register</button>
            </form>
          </main>
    </div>
</div>
@endsection