<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(5);
        return view('category.index', compact('categories'));
    }


    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'code' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }


        Category::create([
            'code' => $request->code,
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('category.index')->with(
            'success',
            'Category created successfully'
        );
    }

    public function show(Category $category) {}


    public function edit(Category $category)
    {
        $category = Category::find($category->id);
        return view('category.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'status' => 'required|in:active,inactive'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }


        $category->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('category.index')->with(
            'success',
            'Category updated successfully'
        );
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with(
            'success',
            'Category deleted successfully'
        );
    }
}
