<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Models\Category;
use App\Models\Log;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories.read')->only('index');
        $this->middleware('permission:categories.create')->only(['new', 'create']);
        $this->middleware('permission:categories.update')->only(['edit', 'update']);
        $this->middleware('permission:categories.delete')->only('destroy');
        $this->middleware('permission:categories.export')->only('export');
    }

    public function index()
    {
        $categories = Category::select('id', 'name', 'description', 'image')->with('products')->filter()->orderBy('id', 'desc')->paginate(10);
        return view('app.categories.index', compact('categories'));
    }

    public function new()
    {
        return view('app.categories.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/categories/' . $filename));
            $path = '/uploads/categories/' . $filename;
        } else {
            $path = "assets/images/no_img.png";
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
        ]);

        $text = ucwords(auth()->user()->name) .  " created Category " . $request->name . ", datetime: " . now();
        Log::create(['text' => $text]);

        return redirect()->route('categories')->with('success', 'Category was successfully created.');
    }

    public function edit(Category $category)
    {
        return view('app.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/categories/' . $filename));
            $path = '/uploads/categories/' . $filename;
        } else {
            $path = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
        ]);

        $text = ucwords(auth()->user()->name) .  " updated Category " . $category->name . ", datetime: " . now();
        Log::create(['text' => $text]);

        return redirect()->route('categories')->with('success', 'Category was successfully updated.');
    }

    public function destroy(Category $category)
    {
        if ($category->can_delete()) {
            $text = ucwords(auth()->user()->name) .  " deleted Category " . $category->name . ", datetime: " . now();

            $category->delete();
            Log::create(['text' => $text]);

            return redirect()->back()->with('danger', 'Category was successfully deleted');
        } else {
            return redirect()->back()->with('danger', 'Unable to delete');
        }
    }

    public function export()
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }
}
