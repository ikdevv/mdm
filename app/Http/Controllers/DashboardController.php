<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $query = Item::query();

        // search by name
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('code', 'like', '%' . request('search') . '%');
        }

        $items = $query->get();
        return view('dashboard', compact('items'));
    }


}
