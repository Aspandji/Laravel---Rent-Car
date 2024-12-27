<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::where('role_id', 2)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'car'])->where('user_id', $user->id)->get();
        return view('dashboard.users.show', [
            'user' => $user,
            'rent_logs' => $rentlogs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('dashboard.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:25',
            // 'password' => 'required|min:8|max:255',
            'phone'    => 'numeric|min:10',
            'address'  => 'required'
        ]);

        // $validatedData['password'] = Hash::make($validatedData['password']);

        $userUpdate = User::where('slug', $slug)->first();

        // Cek jika admin ingin mengubah password
        if ($request->filled('password')) { // untuk memeriksa apakah admin mengisi input password.
            $request->validate([
                'password' => 'required|min:8|max:255',
            ]);
            $validatedData['password'] = Hash::make($request->password);
        } else {
            // Jika password tidak diisi dalam request, password pengguna tidak diubah
            unset($validatedData['password']);
        }

        $userUpdate->status = $request->status;
        $userUpdate->slug = null;
        $userUpdate->update($validatedData);

        return redirect('/dashboard/users')->with('success', 'User has ben Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('/dashboard/users')->with('success', 'User has ben Deleted!');
    }

    public function trashed()
    {
        $trashed = User::onlyTrashed()->get();
        return view('dashboard.users.trashed', [
            'trashedUser' => $trashed
        ]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        return redirect('/dashboard/users')->with('success', 'User Restored Success!');
    }
}
