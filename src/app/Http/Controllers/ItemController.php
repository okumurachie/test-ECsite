<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;

class ItemController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('detail', compact('item'));
    }
    public function showPurchaseForm()
    {
        $cart = session()->get('cart', []);
        return view('purchase', compact('cart'));
    }
    public function processPurchase(PurchaseRequest $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'カートが空です');
        }
        DB::transaction(function () use ($cart, $request) {
            foreach ($cart as $id => $item) {
                $product = Item::findOrFail($id);
                if ($product->stock >= $item['quantity']) {
                    $product->stock -= $item['quantity'];
                    $product->save();

                    Purchase::create([
                        'user_id' => Auth::id(),
                        'item_id' => $product->id,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'payment_method' => $request->payment_method,
                        'post_code' => $request->post_code,
                        'recipient' => $request->recipient,
                    ]);
                } else {
                    throw new \Exception("商品「{$product->name}」の在庫が足りません。");
                }
            }
        });
        session()->forget('cart');
        return redirect('/')->with('message', '購入が完了しました');
    }
}
