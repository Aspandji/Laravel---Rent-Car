@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome, {{ auth()->user()->username }}</h1>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="/dashboard/cars" class="text-decoration-none">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">List Mobil
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-dark">{{ $car_count }} Mobil</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="/dashboard/categories" class="text-decoration-none">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">List Kategori Mobil
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-dark">{{ $category_count }} Kategori</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="/dashboard/users" class="text-decoration-none">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">List Jumlah Client
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-dark">{{ $user_count }} Client</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3>Rent Log History</h3>
    </div>
    <div class="table-responsive">
        <x-rent-log-table :rentlog='$rent_logs' />
    </div>
@endsection
