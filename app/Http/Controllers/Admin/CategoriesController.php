<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\InternCategory;

class CategoriesController extends Controller
{
    private $categoryRep;

    public function __construct(CategoryRepositoryInterface $categoryRep)
    {
        $this->categoryRep = $categoryRep;
    }

    public function paginate(){
        $categories = $this->categoryRep->paginate();

        return view('admin.categories.paginate', compact('categories'));
    }

    public function index()
    {
        $categories = $this->categoryRep->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoriesRequest $request)
    {
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

    public function update(CategoriesRequest $request, InternCategory $category)
    {
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
