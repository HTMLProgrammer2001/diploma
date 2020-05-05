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
        //create new commission
        $data = $request->all();
        $this->categoryRep->create($data);

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(InternCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoriesRequest $request, $category_id)
    {
        $data = $request->all();
        $this->categoryRep->update($category_id, $data);

        return redirect()->route('categories.index');
    }

    public function destroy($category_id)
    {
        $this->categoryRep->destroy($category_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
