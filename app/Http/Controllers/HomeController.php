<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index(){
        $new = Product::where('is_new', true)->take(8)->get();
        $hits = Product::where('is_hit', true)->take(8)->get();
        $sale = Product::where('is_sale', true)->take(8)->get();
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $brands = Brand::take(12)->get();
        return view('home', compact('new','hits','sale','categories','brands'));
    }
}
