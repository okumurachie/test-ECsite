<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
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
        $request->session()->invalidate();
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

    public function edit()
    {
        return view('admin.item.edit', compact('item'));
    }
}
