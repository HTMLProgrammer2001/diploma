<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\LikeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RebukesController extends Controller
{
    public function show($id, RebukeRepositoryInterface $rebukeRepository){
        $rebuke = $rebukeRepository->getById($id);

        return view('admin.rebukes.show', compact('rebuke'));
    }

    public function paginate(Request $request, RebukeRepositoryInterface $rebukeRepository)
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

        $rebukes = $rebukeRepository->filterPaginate($rules);

        return view('admin.rebukes.paginate', [
            'rebukes' => $rebukes,
            'isProfile' => true
        ]);
    }
}
