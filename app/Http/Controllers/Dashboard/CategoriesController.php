<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // return Collection Object
        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $category = Category::create($request->all()); // use mass assignment must assign fillable properties
        return redirect()->route('categories.index')->with('success', 'Category Created');
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            /*  $category =  Category::find($id);
                if (!$category){
                    abort(404);
              }*/
            $categories = Category::where('id', '<>', $id)
                ->where(function ($query) use ($id) {
                    $query->whereNull('parent_id')
                        ->orWhere('parent_id', '<>', $id);
                })->get();
            return view('dashboard.categories.edit', compact('category', 'categories'));
        } catch (Exception $e) {
            //abort(404);
            return redirect()->route('categories.index')->with('info', 'Category Not Found');
        }

    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $category->update($request->all());
        // $category->fill($request->all())->save(); // fill will modify object no DB, save for DB change
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Created');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // Category::where('id', '=', $id)->delete($id);
        // Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Deleted');
    }
}
