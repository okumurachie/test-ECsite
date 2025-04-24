<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('detail', compact('item'));
    }
}
