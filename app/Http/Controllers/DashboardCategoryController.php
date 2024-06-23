<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
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
            'name' => 'required|min:3|max:100|unique:categories',
        ]);

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category has ben Added!');
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
        $category = Category::where('slug', $slug)->first();
        return view('dashboard.categories.edit', [
            'category' => $category
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
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100|unique:categories',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category has ben Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('/dashboard/categories')->with('success', 'Category has ben Deleted!');
    }

    public function trashed()
    {
        $trashed = Category::onlyTrashed()->get();
        return view('dashboard.categories.trashed', [
            'trashed' => $trashed
        ]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->firstOrFail();
        $category->restore();
        return redirect('/dashboard/categories')->with('success', 'Category Restore Success');
    }
}
