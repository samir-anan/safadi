<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index()
    {
        $request = request();
        $categories = Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->filter($request->query())
            //->latest('name') // built in local scope SORTING as parameter provided
            //->orderBy('categories.name','ASC')
            ->paginate();//
/*        $query = Category::query();

        if ($name = $request->query('name')){
            $query->where('name','LIKE',"%{$name}%");
        }
        if($status = $request->query('status')){
            $query->where('status', '=',$status);
           // $query->whereStatus($status);
        }*/

       // $categories = $query->paginate(2); // return Collection Object

        // $categories = Category::active()->paginate(); // using local scope
        // $categories = Category::status('archived')->paginate(); // using dynamic scope

        // $categories = Category::simplepaginate(1); // return next and previous
        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        /* $request->validate(Category::rules(),[
                'name.required' => 'This (:attribute) is required'
            ]);
        */

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

    protected function uploadImage(CategoryRequest $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('categories', [
            'disk' => 'uploads'
        ]);
        return $path;
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
            return redirect()->route('dashboard.categories.index')->with('info', 'Category Not Found');
        }

    }

    public function update(CategoryRequest $request, $id)
    {

       // $request->validate(Category::rules($id));

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $data = $request->except('image');
        $category = Category::find($id);

        $old_image = $category->image;

        $newImage = $this->uploadImage($request);
        if ($newImage){
            $data['image'] = $newImage;
        }

        if ($old_image && isset($newImage)) {
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
        if ($category->image) {
            Storage::disk('uploads')->delete($category->image);
        }
        // Category::where('id', '=', $id)->delete($id);
        // Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category Deleted');
    }
}
