@extends('layouts.main')

@section('container')
    <h1 class="mb-5 text-center">List Mobil</h1>

    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="input-group mb-5">
                        <select class="form-select" name="category">
                            <option selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-text">OR</span>
                        <input type="text" class="form-control" placeholder="Search" name="title">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($cars->count())
        <div class="container">
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card">
                            <img src="{{ $car->image != null ? asset('storage/' . $car->image) : asset('images/image-not-found.png') }}"
                                class="card-img-top" alt="..." style="max-height: 200px; overflow:hidden"
                                draggable="false">
                            <div class="card-body">
                                <div class="d-flex flex-row justify-content-end gap-1">
                                    @if ($car->categories->count())
                                        <span class="badge bg-primary">
                                            @foreach ($car->categories as $category)
                                                {{ $category->name }},
                                            @endforeach
                                        </span>
                                    @else
                                        <span class="d-none">
                                        </span>
                                    @endif
                                    <span
                                        class="badge {{ $car->status == 'in stock' ? 'bg-success' : 'bg-danger' }}">{{ $car->status }}</span>
                                </div>
                                <h2 class="card-title">{{ $car->title }}</h2>
                                <div>
                                    <span class="bi bi-check fs-4"></span>
                                    <span class="d-inline fs-5">Termasuk Supir</span>
                                </div>
                                <div class="mb-3">
                                    <span class="bi bi-x fs-4"></span>
                                    <span class="d-inline fs-5">Tidak Termasuk BBM</span>
                                </div>
                                <a href="/form-rent" class="btn btn-primary">Booking</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No Cars Found</p>
    @endif
@endsection
