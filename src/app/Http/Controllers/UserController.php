<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $items = Item::with('user')->get();
        $items = Item::Paginate(9);
        return view('index', compact('users', 'items'));
    }

    public function store(UserRequest $request)
    {
        $form = $request->all();
        $form['password'] = Hash::make($form['password']);
        User::create($form);

        return redirect('/')->with('message', '会員登録が完了しました');
    }
}
