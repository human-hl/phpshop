<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(){
        User::create([
            'name'=>'Admin',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password'),
            'is_admin'=>true
        ]);
        User::create([
            'name'=>'Customer',
            'email'=>'user@example.com',
            'password'=>Hash::make('password'),
            'is_admin'=>false
        ]);
    }
}
