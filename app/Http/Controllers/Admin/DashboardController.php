<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Небольшая статистика
        $usersCount   = User::count();
        $ordersCount  = Order::count();
        $productsCount = Product::count();

        return view('admin.dashboard', compact('usersCount', 'ordersCount', 'productsCount'));
    }
}
