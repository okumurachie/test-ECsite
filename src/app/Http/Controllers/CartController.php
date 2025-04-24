<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $quantity = (int)$request->input('quantity', 1);

        // 現在のカートをセッションから取得（なければ空配列）
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // 既にあるなら数量を加算
            $cart[$id]['quantity'] += $quantity;
        } else {
            // 新規追加
            $cart[$id] = [
                'name' => $item->name,
                'price' => $item->price,
                'image' => $item->image ?? '',
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect('/item/cart')->with('message', 'カートに追加しました！');
    }

    // カートの中身を見る
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // カートから削除
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('message', 'カートから削除しました。');
    }

    // カートを空にする
    public function clear()
    {
        session()->forget('cart');
        return back()->with('message', 'カートを空にしました。');
    }
}
