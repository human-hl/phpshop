<?php
namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller {
    protected function cartId() {
        if (auth()->check()) return 'user:' . auth()->id();
        if (!session()->has('cart_id')) session(['cart_id' => (string) Str::uuid()]);
        return session('cart_id');
    }

    public function index() {
        $cart_id = $this->cartId();
        $items = CartItem::with('product')->where('cart_id', $cart_id)->get();
        return view('cart.index', compact('items'));
    }

    public function add(Request $request) {
        $request->validate(['product_id'=>'required|exists:products,id','quantity'=>'nullable|integer|min:1']);
        $cart_id = $this->cartId();
        $quantity = $request->quantity ?? 1;
        $item = CartItem::where('cart_id',$cart_id)->where('product_id',$request->product_id)->first();
        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            CartItem::create(['cart_id'=>$cart_id,'product_id'=>$request->product_id,'quantity'=>$quantity]);
        }
        return redirect()->back()->with('success','Товар добавлен в корзину');
    }

    public function update(Request $request, $id) {
        $request->validate(['quantity'=>'required|integer|min:0']);
        $item = CartItem::findOrFail($id);
        if ($request->quantity == 0) { $item->delete(); }
        else { $item->quantity = $request->quantity; $item->save(); }
        return back();
    }

    public function remove($id) {
        $item = CartItem::findOrFail($id);
        $item->delete();
        return back();
    }
}
