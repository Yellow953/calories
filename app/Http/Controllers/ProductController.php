<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Category;
use App\Models\Log;
use App\Models\Product;
use App\Models\SecondaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products.read')->only('index');
        $this->middleware('permission:products.create')->only(['new', 'create']);
        $this->middleware('permission:products.update')->only(['edit', 'update', 'import', 'save', 'images', 'upload']);
        $this->middleware('permission:products.delete')->only('destroy');
        $this->middleware('permission:products.export')->only('export');
    }

    public function index()
    {
        $products = Product::select('id', 'name', 'stock', 'cost', 'price', 'image', 'category_id', 'description')->filter()->orderBy('id', 'desc')->paginate(10);
        $categories = Category::select('id', 'name')->get();

        $data = compact('products', 'categories');
        return view('app.products.index', $data);
    }

    public function new()
    {
        $categories = Category::select('id', 'name')->get();
        return view('app.products.new', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'stock' => 'required|numeric|min:1',
            'cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required',
            'barcodes' => 'array',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = auth()->user()->id . '_' . time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/products/' . $filename));
            $path = '/uploads/products/' . $filename;
        } else {
            $path = "assets/images/no_img.png";
        }

        $product = Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'cost' => $request->cost,
            'price' => $request->price,
            'compare_price' => $request->compare_price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $path,
        ]);

        $text = ucwords(auth()->user()->name) .  " created Product: " . $product->name . ", datetime: " . now();
        Log::create(['text' => $text]);

        return redirect()->route('products')->with('success', 'Product was successfully created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        $data = compact('categories', 'product');

        return view('app.products.edit', $data);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = auth()->user()->id . '_' . time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/products/' . $filename));
            $path = '/uploads/products/' . $filename;
        } else {
            $path = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'price' => $request->price,
            'compare_price' => $request->compare_price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $path,
        ]);

        $text = ucwords(auth()->user()->name) .  " updates Product: " . $request->name . ", datetime: " . now();
        Log::create(['text' => $text]);

        return redirect()->route('products')->with('success', 'Product was successfully updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->can_delete()) {
            $text = ucwords(auth()->user()->name) .  " deleted Product: " . $product->name . ", datetime: " . now();

            if ($product->image != 'assets/images/no_img.png') {
                $path = public_path($product->image);
                File::delete($path);
            }

            $product->delete();
            Log::create(['text' => $text]);

            return redirect()->back()->with('danger', 'Product was successfully deleted...');
        } else {
            return redirect()->back()->with('danger', 'Unable to delete Product...');
        }
    }

    public function import(Product $product)
    {
        return view('app.products.import', compact('product'));
    }

    public function save(Product $product, Request $request)
    {
        $request->validate([
            'stock' => 'required|numeric|min:0',
        ]);

        $product->update([
            'stock' => $product->stock + $request->stock,
        ]);

        Log::create([
            'text' => ucwords(auth()->user()->name) . ' imported ' . $request->stock . ' pcs to Product: ' . $product->name . ', datetime: ' . now(),
        ]);

        return redirect()->route('products')->with('success', 'Stock Imported Successfully...');
    }

    public function images(Product $product)
    {
        return view('app.products.images', compact('product'));
    }

    public function upload(Product $product, Request $request)
    {
        $this->validate($request, [
            'images.*' => 'image'
        ]);

        $counter = 0;

        foreach ($request->file('images') as $image) {
            $ext = $image->getClientOriginalExtension();
            $filename = time() . '-' . $counter . '.' . $ext;
            $picture = Image::make($image);
            $picture->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $picture->move('uploads/products/', $filename);
            $path = '/uploads/products/' . $filename;

            SecondaryImage::create([
                'product_id' => $product->id ?? null,
                'path' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $counter++;
        }

        return redirect()->route('products')->with('success', 'Images Upleaded Successfully...');
    }

    public function clean(SecondaryImage $image)
    {
        $path = public_path($image->path);
        File::delete($path);
        $image->delete();

        return redirect()->back()->with('danger', 'Image deleted...');
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
