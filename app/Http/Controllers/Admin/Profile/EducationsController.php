<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Education;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationsRequest;
use Illuminate\Support\Facades\Auth;

class EducationsController extends Controller
{
    public function paginate(){
        $user = Auth::user();
        $educations = $user->educations()->paginate(env('PAGINATE_SIZE', 10));

        return view('admin.educations.paginate', [
            'educations' => $educations,
            'isProfile' => true
        ]);
    }

    public function create(){
        return view('admin.profile.educations.create');
    }

    public function store(EducationsRequest $request){
        $education = new Education($request->all());

        $education->setUser($request->user()->id);
        $education->save();

        return redirect()->route('profile.show');
    }

    public function edit(Education $education){
        return view('admin.profile.educations.edit', compact('education'));
    }

    public function update(Education $education, EducationsRequest $request){
        $education->fill($request->all());
        $education->save();

        return redirect()->route('profile.show');
    }
}
