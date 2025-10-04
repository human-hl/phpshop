<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder {
    public function run(){
        Page::create(['title'=>'About','slug'=>'about','content'=>'About us page content']);
        Page::create(['title'=>'Delivery','slug'=>'delivery','content'=>'Delivery info']);
    }
}
