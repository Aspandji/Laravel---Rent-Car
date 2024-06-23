<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.cars.index', [
            'cars' => Car::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cars.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'car_code' => 'required|max:255',
            'title' => 'required|min:3|max:255',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $car = Car::create($validatedData);
        $car->categories()->sync($request->categories);

        return redirect('/dashboard/cars')->with('success', 'Category has ben Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $car = Car::where('slug', $slug)->first();
        $categories = Category::all();
        return view('dashboard.cars.edit', [
            'car' => $car,
            'categories' => $categories
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
            'car_code' => 'required|max:255',
            'title' => 'required|min:3|max:255',
            'image' => 'image|file|max:1024',
        ]);

        // $validatedData = $request->validate($rules);

        // if ($request->file('image')) {
        //     if ($car->image) {
        //         Storage::delete($car->image);
        //     }
        //     $request->file('image')->store('post-images');
        // }

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $carUpdate = Car::where('slug', $slug)->first();
        $carUpdate->slug = null;
        $carUpdate->update($validatedData);

        if ($request->categories) {
            $carUpdate->categories()->sync($request->categories);
        }

        return redirect('/dashboard/cars')->with('success', 'Category has ben Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $car = Car::where('slug', $slug)->first();
        $car->delete();
        return redirect('/dashboard/cars')->with('success', 'Car has ben Deleted!');
    }

    public function trashed()
    {
        $trashed = Car::onlyTrashed()->get();
        return view('dashboard.cars.trashed', [
            'trashed' => $trashed
        ]);
    }

    public function restore($slug)
    {
        $car = Car::withTrashed()->where('slug', $slug)->firstOrFail();
        $car->restore();

        return redirect('/dashboard/cars')->with('success', 'Car Restored Success!');
    }
}
