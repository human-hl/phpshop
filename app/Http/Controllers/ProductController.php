<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index(Request $request, $categorySlug = null) {
        $query = Product::query();
        if ($request->filled('filter')) {
            $filter = $request->input('filter');
            if ($filter === 'new') $query->where('is_new', true);
            if ($filter === 'hit') $query->where('is_hit', true);
            if ($filter === 'sale') $query->where('is_sale', true);
        }
        if ($request->filled('min') || $request->filled('max')) {
            if ($request->filled('min')) $query->where('price', '>=', $request->min);
            if ($request->filled('max')) $query->where('price', '<=', $request->max);
        }
        if ($categorySlug) {
            $category = Category::where('slug',$categorySlug)->firstOrFail();
            $query->where('category_id', $category->id);
        }
        $products = $query->paginate(12);
        $categories = Category::whereNull('parent_id')->get();
        $brands = \App\Models\Brand::take(12)->get();
        return view('catalog.index', compact('products','categories','brands'));
    }

    public function show($slug) {
        $product = Product::where('slug',$slug)->with('images','brand','category')->firstOrFail();
        return view('catalog.show', compact('product'));
    }
}
