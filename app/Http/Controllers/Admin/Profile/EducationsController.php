<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationsRequest;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\LikeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationsController extends Controller
{
    private $userRep, $educationRep;

    public function __construct(UserRepositoryInterface $userRep, EducationRepositoryInterface $educationRep)
    {
        $this->userRep = $userRep;
        $this->educationRep = $educationRep;
    }

    public function paginate(Request $request){
        //create rules array
        $rules = [];

        $rules[] = new EqualRule('user_id', Auth::user()->id);

        if($request->input('qualification'))
            $rules[] = new EqualRule('qualification', $request->input('qualification'));

        if($request->input('name'))
            $rules[] = new LikeRule('institution', $request->input('name'));

        if($request->input('graduate_year'))
            $rules[] = new EqualRule('graduate_year', $request->input('graduate_year'));

        $educations = $this->educationRep->filterPaginate($rules);

        return view('admin.educations.paginate', [
            'educations' => $educations,
            'isProfile' => true
        ]);
    }

    public function create(){
        return view('admin.profile.educations.create');
    }

    public function store(EducationsRequest $request){
        $data = $request->all();
        $data['user'] = Auth::user()->id;
        $this->educationRep->create($data);

        return redirect()->route('profile.show');
    }

    public function edit($education_id){
        $education = $this->educationRep->getById($education_id);

        if(!$education)
            return abort(404);

        return view('admin.profile.educations.edit', compact('education'));
    }

    public function update(EducationsRequest $request, $education_id){
        $data = $request->all();
        $data['user'] = Auth::user()->id;
        $this->educationRep->update($education_id, $data);

        return redirect()->route('profile.show');
    }

    public function destroy($education_id){
        $this->educationRep->destroy($education_id);

        return response()->json([
            'result' => 'OK'
        ]);
    }
}
