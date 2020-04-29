<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InternCategory;

class CategoriesController extends Controller
{
    public function paginate(){
        $categories = InternCategory::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.categories.paginate', compact('categories'));
    }

    public function index()
    {
        $categories = InternCategory::paginate(env('PAGINATE_SIZE', 10));

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string'
        ]);

        $category = new InternCategory();
        $category->fill($request->all());
        $category->save();

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(InternCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, InternCategory $category)
    {
        $this->validate($request, [
           'name' => 'required|string'
        ]);

        $category->fill($request->all());
        $category->save();

        return redirect()->route('categories.index');
    }

    public function destroy(InternCategory $category)
    {
        $category->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
