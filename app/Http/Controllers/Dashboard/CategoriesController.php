<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Termwind\Components\Raw;

use function Pest\Laravel\delete;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $query = Category::query();


        // if ($name = $request->query('name')) {
        //     $query->where('name', 'like', "%{$name}%");
        // }$file->store('uploads');



        // if ($status = $request->query('status')) {
        //     $query->where('status', '=', $status);
        // }


        // $categories = $query->paginate(1);
        // DB::table('Categories');
        // $categories = Category::status('active')->paginate();
        $categories = Category::with('parent')
            // ->select('categories.*')
            // ->selectRaw('(SELECT COUNT(*) FROM products WHERE Category_id = categories.id) as products_count') هنعوض عنهم بحاجة اسهل عن طريق الريلشن
            // select raw : لازم ابعتلها اسم coloum
            ->withCount([
                'products as products_count' => function ($query) {
                    $query->where('status', '=', 'active');
                }
            ])
            ->filter($request->query())
            ->orderBy('categories.name')
            ->paginate(3);
        return view("dashboard.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new category();


        return view("dashboard.categories.create", compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->route('id');

        // Validate request
        $request->validate(Category::rules(), [
            'required' => 'This field (:attribute) is required',
            'unique' => 'This name is taken'
        ]);

        // Prepare data
        $data = $request->only(['name', 'parent_id', 'description', 'status']);
        $data['slug'] = Str::slug($request->post("name"));

        // Upload image if exists
        $data['image'] = $this->UploadImage($request);

        // Create category
        $category = Category::create($data);

        // Redirect with success message
        return Redirect::route("dashboard.categories.index")
            ->with('success', 'Category created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',[
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);


        if (! $category) {
            return Redirect::route("dashboard.categories.index")
                ->with('error', 'Not Founded !');
        }

        // $parents = Category::all();
        $parents =  Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    public function update(CategoryRequest $request, $id)
    {
        // $request->validate(Category::rules($id));

        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');

        $new_image = $this->UploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);
        $category->parent_id = $request->post('parent_id');
        $category->save();

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route("dashboard.categories.index")
            ->with('success', 'Category updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
        // // Category::destroy($id);

        return Redirect::route("dashboard.categories.index")
            ->with('success', 'Category deleted.');
    }
    protected function UploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $file->store('uploads');
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }
    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
            ->with('Success', 'Category Restored !!');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        // delete image from disk if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->forceDelete();

        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Category Deleted !!');
    }
}
