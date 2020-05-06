<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\QualificationRequest;
use App\Qualification;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class QualificationsController extends Controller
{
    private $qualificationRep;

    public function __construct(QualificationRepositoryInterface $qualificationRep)
    {
        //$this->authorizeResource(Qualification::class, 'qualification');

        $this->qualificationRep = $qualificationRep;
    }

    public function paginate(){
        $user_id = Auth::user()->id;
        $qualifications = $this->qualificationRep->paginateForUser($user_id);

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
        $qualificationNames = $this->qualificationRep->getQualificationNames();

        return view('admin.profile.qualifications.create',
            compact('curUser', 'qualificationNames'));
    }

    public function store(QualificationRequest $request)
    {
        $data = $request->all();
        $this->qualificationRep->create($data);

        return redirect()->route('profile.show');
    }

    public function show()
    {
        return abort(404);
    }

    public function edit()
    {
        return abort(404);
    }

    public function update()
    {
        return abort(404);
    }

    public function destroy($qualification_id)
    {
        $this->qualificationRep->destroy($qualification_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
