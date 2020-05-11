<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\HonorRepositoryInterface;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\LikeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorsController extends Controller
{
    private $honorRep;

    public function __construct(HonorRepositoryInterface $honorRep)
    {
        $this->honorRep = $honorRep;
    }

    public function show($id){
        $honor = $this->honorRep->getById($id);

        return view('admin.honors.show', compact('honor'));
    }

    public function paginate(Request $request)
    {
        //create rules for filter
        $rules = [];

        $rules[] = new EqualRule('user_id', Auth::user()->id);

        if($request->input('name'))
            $rules[] = new LikeRule('title', $request->input('name'));

        if($request->input('start_date_presentation'))
            $rules[] = new DateMoreRule('date_presentation',
                $request->input('start_date_presentation'));

        if($request->input('end_date_presentation'))
            $rules[] = new DateLessRule('date_presentation',
                $request->input('end_date_presentation'));

        $honors = $this->honorRep->filterPaginate($rules);

        return view('admin.honors.paginate', [
            'honors' => $honors,
            'isProfile' => true
        ]);
    }
}
