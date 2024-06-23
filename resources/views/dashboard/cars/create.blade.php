@extends('dashboard.layouts.main')

@section('container')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Car</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/cars" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="car_code" class="form-label">Code</label>
                <input type="text" class="form-control @error('car_code') is-invalid @enderror" id="car_code"
                    name="car_code" placeholder="Code Mobil" required autofocus value="{{ old('car_code') }}">
                @error('car_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Nama Mobil</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" placeholder="Nama Mobil" required autofocus value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-control select-multiple @error('category') is-invalid @enderror" name="categories[]"
                    multiple>
                    @foreach ($categories as $category)
                        @if (old('category') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="my-3">
                <label for="image" class="form-label">Gambar</label>
                <img src="" class="img-preview img-fluid mb-3 col-sm-5" id="frame"
                    style="max-height: 500px; overflow:hidden">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="preview()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Car</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
    <script>
        function preview() {
            const frame = document.querySelector('#frame');
            frame.style.display = 'block';
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
