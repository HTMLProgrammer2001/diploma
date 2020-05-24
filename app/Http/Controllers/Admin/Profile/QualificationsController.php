<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\QualificationRequest;
use App\Qualification;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use App\Repositories\Rules\DateLessRule;
use App\Repositories\Rules\DateMoreRule;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\SortRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualificationsController extends Controller
{
    private $qualificationRep;

    public function __construct(QualificationRepositoryInterface $qualificationRep)
    {
        $this->authorizeResource(Qualification::class, 'qualification');

        $this->qualificationRep = $qualificationRep;
    }

    private function createRule(array $data): array {
        //create rules array
        $rules = [];

        //add rules
        $rules[] = new EqualRule('user_id', Auth::user()->id);

        if($data['category'] ?? false)
            $rules[] = new EqualRule('name', $data['category']);

        if($data['start_date'] ?? false)
            $rules[] = new DateMoreRule('date', from_locale_date($data['start_date']));

        if($data['end_date'] ?? false)
            $rules[] = new DateLessRule('date', from_locale_date($data['end_date']));

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortName'] ?? false)
            $rules[] = new SortRule('name', $data['sortName'] == 1 ? 'ASC' : 'DESC');

        if($data['sortDate'] ?? false)
            $rules[] = new SortRule('date', $data['sortDate'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        $rules = $this->createRule($request->input());
        $qualifications = $this->qualificationRep->filterPaginate($rules);

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

    public function show(Qualification $qualification)
    {
        return view('admin.qualifications.show', compact('qualification'));
    }

    public function edit()
    {
        return abort(404);
    }

    public function update()
    {
        return abort(404);
    }

    public function destroy(Qualification $qualification)
    {
        $this->qualificationRep->destroy($qualification->id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
