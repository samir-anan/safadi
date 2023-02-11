<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // return Collection Object
        return view('dashboard.categories.index',compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create',compact('categories'));
    }

    public function store(Request $request)
    {

        $request->merge([
           'slug' => Str::slug($request->name)
        ]);
        $category = Category::create($request->all()); // use mass assignment must assign fillable properties
        return redirect()->route('categories.index')->with('success','Category Created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
