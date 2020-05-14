<?php

namespace App\Http\Controllers\Admin;

use App\Education;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationsRequest;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Rules\EqualRule;
use App\Repositories\Rules\HasAssociateRule;
use App\Repositories\Rules\LikeRule;
use App\Repositories\Rules\SortAssociateRule;
use App\Repositories\Rules\SortRule;
use Illuminate\Http\Request;

class EducationsController extends Controller
{
    private $educationRep, $userRep;

    public function __construct(EducationRepositoryInterface $educationRep, UserRepositoryInterface $userRep)
    {
        $this->educationRep = $educationRep;
        $this->userRep = $userRep;
    }

    private function createRule(array $data): array {
        $rules = [];

        if($data['user'] ?? false)
            $rules[] = new EqualRule('user_id', $data['user']);

        if($data['qualification'] ?? false)
            $rules[] = new EqualRule('qualification', $data['qualification']);

        if($data['name'] ?? false)
            $rules[] = new LikeRule('institution', $data['name']);

        if($data['graduate_year'] ?? false)
            $rules[] = new EqualRule('graduate_year', $data['graduate_year']);

        if($data['sortID'] ?? false)
            $rules[] = new SortRule('id', $data['sortID'] == 1 ? 'ASC' : 'DESC');

        if($data['sortInstitution'] ?? false)
            $rules[] = new SortRule('institution',
                $data['sortInstitution'] == 1 ? 'ASC' : 'DESC');

        if($data['sortYear'] ?? false)
            $rules[] = new SortRule('graduate_year',
                $data['sortYear'] == 1 ? 'ASC' : 'DESC');

        if($data['sortQualification'] ?? false)
            $rules[] = new SortRule('qualification',
                $data['sortQualification'] == 1 ? 'ASC' : 'DESC');

        if($data['sortUser'] ?? false)
            $rules[] = new SortAssociateRule(['users', 'users.id', '=', 'educations.user_id'], 'educations.*',
                'users.surname', $data['sortUser'] == 1 ? 'ASC' : 'DESC');

        return $rules;
    }

    public function paginate(Request $request){
        //create rules array
        $rules =  $this->createRule($request->input());
        $educations = $this->educationRep->filterPaginate($rules);

        return view('admin.educations.paginate', compact('educations'));
    }

    public function index()
    {
        $educations = $this->educationRep->paginate();
        $qualifications = Education::QUALIFICATIONS;
        $users = $this->userRep->getForCombo();

        return view('admin.educations.index', compact('educations', 'users', 'qualifications'));
    }

    public function create()
    {
        $qualifications = Education::QUALIFICATIONS;
        $users = $this->userRep->getForCombo();

        return view('admin.educations.create', compact('users', 'qualifications'));
    }

    public function store(EducationsRequest $request)
    {
        //create education
        $data = $request->all();
        $this->educationRep->create($data);

        return redirect()->route('educations.index');
    }

    public function show($id)
    {
        $education = $this->educationRep->getById($id);

        return view('admin.educations.show', compact('education'));
    }

    public function edit($education_id)
    {
        $education = $this->educationRep->getById($education_id);

        if(!$education)
            return abort(404);

        $users = $this->userRep->getForCombo();

        return view('admin.educations.edit', compact('education', 'users'));
    }

    public function update(EducationsRequest $request, $education_id)
    {
        $data = $request->all();
        $this->educationRep->update($education_id, $data);

        return redirect()->route('educations.index');
    }

    public function destroy($education_id)
    {
        $this->educationRep->destroy($education_id);

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
