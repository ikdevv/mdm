<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{


    public function index()
    {
        
        $brands = Brand::where('created_by', auth()->id())->paginate(5);
        return view('brand.index', compact('brands'));
    }


    public function create()
    {
        return view('brand.create');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $brand = new Brand(
            [
                'code' => $request->code,
                'name' => $request->name,
                'status' => $request->status,
                'created_by' => auth()->user()->id
            ]
        );

        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand created successfully');
    }


    public function show(Brand $brand) {}


    public function edit(Brand $brand)
    {
        $brand = Brand::find($brand->id);
        return view('brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }


        $brand->update([

            'name' => $request->name,
            'status' => $request->status,
        ]);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully');
    }
}
