<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Rules\LikeRule;
use App\Repositories\Rules\SortRule;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $categoryRep;

    public function __construct(CategoryRepositoryInterface $categoryRep)
    {
        $this->categoryRep = $categoryRep;
    }

    public function paginate(Request $request){
        //fill rules array
        $rules = [];

        if($request->input('name'))
            $rules[] = new LikeRule('name', $request->input('name'));

        if($request->input('sortID'))
            $rules[] = new SortRule('id', $request->input('sortID') == 1 ? 'ASC' : 'DESC');

        if($request->input('sortName'))
            $rules[] = new SortRule('name', $request->input('sortName') == 1 ? 'ASC' : 'DESC');

        $categories = $this->categoryRep->filterPaginate($rules);

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

    public function show()
    {
        return abort(404);
    }

    public function edit($category_id)
    {
        $category = $this->categoryRep->getById($category_id);

        if(!$category)
            return abort(404);

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
