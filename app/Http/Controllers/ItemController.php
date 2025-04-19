<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use App\Exports\ItemsExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::where('created_by', auth()->id())->paginate(5);
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
                'created_by' => auth()->user()->id
            ]
        );

        return redirect()->route('item.index')->with('success', 'Item created successfully');
    }


    public function show(Item $item)
    {
    }


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


    public function exportExcel()
    {
        return Excel::download(new ItemsExport(), 'items.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new ItemsExport(), 'items.csv');
    }

    public function exportPdf()
    {
        $items = Item::all();
        $pdf = Pdf::loadView('exports.items_pdf', compact('items'));
        return $pdf->download('items.pdf');
    }

}
