<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder {
    public function run(){
        $cat = Category::first();
        $brand = Brand::first();
        Product::create([
            'category_id'=>$cat->id,
            'brand_id'=>$brand->id,
            'name'=>'Test Phone',
            'slug'=>'test-phone',
            'description'=>'Test phone description',
            'price'=>199.99,
            'stock'=>50,
            'is_new'=>true,
            'is_hit'=>true,
            'main_image'=>null,
        ]);
    }
}
