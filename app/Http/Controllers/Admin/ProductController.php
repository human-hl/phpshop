<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories','brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'slug'=>'required|string|unique:products,slug',
            'price'=>'required|numeric|min:0',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
        ]);

        $product = Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success','Товар создан');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product','categories','brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'slug'=>'required|string|unique:products,slug,'.$product->id,
            'price'=>'required|numeric|min:0',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'nullable|exists:brands,id',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success','Товар обновлён');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Товар удалён');
    }
}
