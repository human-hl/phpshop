<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run(){
        $c1 = Category::create(['name'=>'Phones','slug'=>'phones']);
        $c2 = Category::create(['name'=>'Laptops','slug'=>'laptops']);
        $c3 = Category::create(['name'=>'Accessories','slug'=>'accessories']);
    }
}
