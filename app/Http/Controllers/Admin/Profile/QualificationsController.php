<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\QualificationRequest;
use App\Qualification;
use Illuminate\Support\Facades\Auth;

class QualificationsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Qualification::class, 'qualification');
    }

    public function paginate(){
        $user = Auth::user();
        $qualifications = $user->qualifications()->paginate(env('PAGINATE_SIZE', 10));

        return view('admin.qualifications.paginate', [
           'qualifications' => $qualifications,
           'isProfile' => true
        ]);
    }

    public function index()
    {
        return abort(404);
    }

    public function create()
    {
        $curUser = Auth::user();
        $qualificationNames = Qualification::getQualificationNames();

        return view('admin.profile.qualifications.create',
            compact('curUser', 'qualificationNames'));
    }

    public function store(QualificationRequest $request)
    {
        $qualification = new Qualification();
        $qualification->fill($request->all());
        $qualification->date = $request->get('date');

        $qualification->setUser($request->user()->id);
        $qualification->save();

        return redirect()->route('profile.show');
    }

    public function show($id)
    {
        return abort(404);
    }

    public function edit(Qualification $qualification)
    {
        return abort(404);
    }

    public function update(QualificationRequest $request, Qualification $qualification)
    {
        return abort(404);
    }

    public function destroy(Qualification $qualification)
    {
        $qualification->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
