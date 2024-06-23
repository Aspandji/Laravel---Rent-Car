<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $carCount = Car::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentlogs = RentLogs::with(['user', 'car'])->get();
        return view('dashboard.index', [
            'car_count' => $carCount,
            'category_count' => $categoryCount,
            'user_count' => $userCount,
            'rent_logs' => $rentlogs
        ]);
    }
}
