<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->title) {
            // Berdasarkan title
            $cars = Car::where('title', 'like', '%' . $request->title . '%')->get();
        } elseif ($request->category || $request->title) {
            // Berdasarkan Title dan Category atau Category saja
            $cars = Car::where('title', 'like', '%' . $request->title . '%')
                ->WhereHas('categories', function ($query) use ($request) {
                    $query->where('categories.id', $request->category);
                })->get();
        } else {
            $cars = Car::all();
        }


        return view('cars', [
            'title' => 'List Mobil',
            'active' => 'cars',
            'cars' => $cars,
            'categories' => $categories
        ]);
    }

    public function rent()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $cars = Car::all();
        return view('form-rent', [
            'title' => 'Form Peminjaman',
            'active' => 'cars',
            'user' => $user,
            'cars' => $cars
        ]);
    }

    public function store(Request $request)
    {
        $rent_date = $request->rent_date;
        $request['return_date'] = (new Carbon($rent_date))->addDays(3)->toDateString();

        // Jika mobil sedang dibooking
        $car = Car::findOrFail($request->car_id)->only('status');
        if ($car['status'] != 'in stock') {
            Session::flash('message', 'Maaf Mobil Sedang dibooking');
            Session::flash('alert-class', 'alert-danger');
            return redirect('form-rent');
        } else {
            // jika user sudah mencapai limit
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();
            if ($count >= 1) {
                Session::flash('message', 'Maaf User Telah Mencapai Limit Booking');
                Session::flash('alert-class', 'alert-danger');
                return redirect('form-rent');
            } else {
                try {
                    DB::beginTransaction();
                    // Proses Insert to rent_logs table
                    RentLogs::create($request->all());
                    // proses Update cars table
                    $car = Car::findOrFail($request->car_id);
                    $car->status = 'out stock';
                    $car->save();
                    DB::commit();

                    Session::flash('message', 'Mobil berhasil dibooking');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('form-rent');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }
}
