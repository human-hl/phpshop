<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller {
    public function showForm(){
        $cart_id = auth()->check() ? 'user:'.auth()->id() : session('cart_id');
        $items = CartItem::with('product')->where('cart_id',$cart_id)->get();
        return view('checkout.form', compact('items'));
    }

    public function placeOrder(Request $request) {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'address'=>'required|string',
            'city'=>'required|string',
            'zip'=>'nullable|string',
        ]);
        $cart_id = auth()->check() ? 'user:'.auth()->id() : session('cart_id');
        $items = CartItem::with('product')->where('cart_id',$cart_id)->get();
        if ($items->isEmpty()) return redirect()->route('cart.index')->withErrors('Корзина пуста');

        DB::transaction(function() use($request,$items){
            $total = $items->sum(function($i){ return $i->quantity * $i->product->price; });
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'new',
                'total' => $total,
                'shipping_address' => [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'zip'=>$request->zip,
                ]
            ]);
            foreach($items as $i){
                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$i->product_id,
                    'quantity'=>$i->quantity,
                    'price'=>$i->product->price,
                ]);
                $i->product->decrement('stock', $i->quantity);
                $i->delete();
            }
        });

        return redirect()->route('home')->with('success','Заказ принят');
    }
}
