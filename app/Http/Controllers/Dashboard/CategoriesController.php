<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        ]);  // $request->merge add new value not in request, never update exist value

        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);
/*        if ($request->hasFile('image')){
            $file = $request->file('image');
            // $path = $file->store('uploads','public'); // store in "uploads" directory in default disk with random name
            $path = $file->storeAs('uploads', $name,['disk' => 'public']); // other way
            $data['image'] = $path;
        }*/

        $category = Category::create($data); // use mass assignment must assign fillable properties
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Created');
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
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $data = $request->except('image');
        $category = Category::find($id);

        $old_image = $category->image;

        $data['image'] = $this->uploadImage($request);

        if ($old_image && isset($category->image)){
            Storage::disk('uploads')->delete($old_image);
        }
        $category->update($data);
        // $category->fill($request->all())->save(); // fill will modify object no DB, save for DB change
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Created');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image){
            Storage::disk('uploads')->delete($category->image);
        }
        // Category::where('id', '=', $id)->delete($id);
        // Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Deleted');
    }

    protected function uploadImage(Request $request){
        if (!$request->hasFile('image')){
            return;
        }
        $file = $request->file('image');
        $path = $file->store('categories',[
            'disk' => 'uploads'
        ]);
        return $path;
    }
}
