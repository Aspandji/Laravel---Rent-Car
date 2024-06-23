<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user', 'car'])->where('user_id', Auth::user()->id)->get();
        return view('profile_user.index', [
            'rent_logs' => $rentlogs
        ]);
    }
}
