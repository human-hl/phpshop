<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder {
    public function run(){
        Brand::create(['name'=>'BrandA','slug'=>'brand-a']);
        Brand::create(['name'=>'BrandB','slug'=>'brand-b']);
    }
}
