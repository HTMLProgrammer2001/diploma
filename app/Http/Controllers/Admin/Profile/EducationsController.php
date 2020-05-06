<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationsRequest;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EducationsController extends Controller
{
    private $userRep, $educationRep;

    public function __construct(UserRepositoryInterface $userRep, EducationRepositoryInterface $educationRep)
    {
        $this->userRep = $userRep;
        $this->educationRep = $educationRep;
    }

    public function paginate(){
        $user_id = Auth::user()->id;
        $educations = $this->educationRep->paginateForUser($user_id);

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
