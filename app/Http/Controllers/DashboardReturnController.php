<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardReturnController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $cars = Car::all();
        return view('dashboard.return.index', [
            'users' => $users,
            'cars' => $cars,
        ]);
    }

    public function returnCar(Request $request)
    {
        // User dan mobil yang dipilih untuk direturn benar, maka berhasil return mobil
        // User dan mobil yang dipilih untuk direturn salah, maka muncul error notice
        $rent = RentLogs::where('user_id', $request->user_id)->where('car_id', $request->car_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();

        if ($countData == 1) {
            // maka mobil di return
            try {
                DB::beginTransaction();
                // Proses Insert to rent_logs table
                $rentData->actual_return_date = Carbon::now()->toDateString();
                $rentData->save();
                // proses Update cars table
                $car = Car::findOrFail($request->car_id);
                $car->status = 'in stock';
                $car->save();
                DB::commit();

                Session::flash('message', 'Mobil berhasil dikembalikan');
                Session::flash('alert-class', 'alert-success');
                return redirect('dashboard/rent-return');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        } else {
            Session::flash('message', 'User atau Mobil tidak sesuai, Mohon Cek Kembali !!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('dashboard/rent-return');
        }
    }
}
