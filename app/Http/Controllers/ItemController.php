<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::paginate(5);
        return view('item.index', compact('items'));
    }


    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('item.create', compact('categories', 'brands'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        Item::create(
            [
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'code' => $request->code,
                'name' => $request->name,
                'status' => $request->status,
            ]
        );

        return redirect()->route('item.index')->with('success', 'Item created successfully');
    }


    public function show(Item $item) {}


    public function edit(Item $item)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('item.edit', compact('item', 'categories', 'brands'));
    }

    public function update(Request $request, Item $item)
    {

        $item = Item::find($item->id);

        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }


        $item->update(
            [
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'status' => $request->status,
            ]
        );

        return redirect()->route('item.index')->with('success', 'Item updated successfully');
    }


    public function destroy(Item $item)
    {
        $item = Item::find($item->id);
        $item->delete();
        return redirect()->route('item.index')->with('success', 'Item deleted successfully');
    }
}
