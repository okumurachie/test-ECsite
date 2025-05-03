<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\EditRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard')->with('message', '管理者ログインしました');
            }
            Auth::logout();
        }

        return back()->withErrors([
            'email' => '管理者アカウントが見つかりません。',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();    //セッションを無効化
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
        ]);

        // 自動ログインさせるなら
        auth()->login($admin);

        return redirect('/admin/dashboard')->with('message', '管理者登録が完了しました');
    }

    public function add()
    {
        $items = Item::with('user')->get();
        $users = User::all();
        return view('admin.item.add', compact('items', 'users'));
    }
    public function store(ItemRequest $request)
    {

        $itemData = $request->all();
        $itemData['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            //Log::debug('test');
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/images', $fileName);
            $itemData['image'] = 'storage/images/' . $fileName;
        }
        //exit;
        Item::create($itemData);
        return redirect('/admin/dashboard')->with('message', '商品登録が完了しました');
    }

    public function showEditList()
    {
        $items = Item::with('user')->get();
        return view('admin.item.list', compact('items'));
    }
    public function edit($id)
    {
        $item = Item::find($id);
        return view('admin.item.edit', compact('item'));
    }
    public function update(EditRequest $request, $id)
    {
        $item = item::findOrFail($id);

        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->description = $request->input('description');

        if ($request->filled('add_stock')) {
            $item->stock += (int) $request->input('add_stock');
        }
        $item->save();
        return redirect('/admin/dashboard')->with('message', '出品情報を更新しました');
    }
    public function imageUpdate(ImageRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        // 古い画像を削除（あれば）
        if ($item->image) {
            $oldImagePath = str_replace('storage/', 'public/', $item->image);
            if (\Storage::exists($oldImagePath)) {
                \Storage::delete($oldImagePath);
            }
        }
        //保存する時は 'storage/images/ファイル名'でも、実際は 'public/images/ファイル名' にあるから。str_replaceする。

        //新しい画像をアップロード
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/images', $fileName);
        // $itemData['image'] = 'storage/images/' . $fileName;  $itemData使っていないので削除
        $item->image = 'storage/images/' . $fileName;  //画像パスを更新
        $item->save(); //DBに保存
        return redirect('/admin/dashboard')->with('message', '画像を更新しました');
    }
    public function delete(Request $request)
    {
        $item = item::find($request->id);
        //return view('edit', ['form' => $items]);
        return view('admin.item.delete', compact('item'));
    }
    public function softDelete($id)
    {
        $item = item::findOrFail($id);
        $item->delete();
        return redirect('/admin/dashboard')->with('message', '出品を取り消しました');
    }
    public function showShippingList()
    {
        $user = auth()->user();
        $purchases = Purchase::where('shipping_status', 0)->get();
        return view('admin.item.shipping_list', compact('purchases'));
    }
    public function ship($id)
    {
        $purchase = Purchase::findOrFail($id);
        if (Auth::id() === $purchase->user_id) {
            $purchase->shipping_status = 1;
            $purchase->save();
        }
        return redirect('/admin/dashboard')->with('message', '商品を発送しました');
    }
}
