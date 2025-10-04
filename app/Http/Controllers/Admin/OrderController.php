<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller {
    public function __construct(){ $this->middleware(['auth','is_admin']); }
    public function index(){ $orders = Order::with('user')->orderBy('created_at','desc')->paginate(30); return view('admin.orders.index',compact('orders')); }
    public function show(Order $order){ $order->load('items.product','user'); return view('admin.orders.show', compact('order')); }
    public function updateStatus(Request $r, Order $order){
        $r->validate(['status'=>'required|in:new,processing,shipped,canceled,completed']);
        $order->status = $r->status;
        $order->save();
        return back()->with('success','Статус обновлён');
    }
}
