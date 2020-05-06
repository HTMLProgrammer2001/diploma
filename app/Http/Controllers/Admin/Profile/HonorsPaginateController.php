<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\HonorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorsPaginateController extends Controller
{
    private $honorRep;

    public function __construct(HonorRepositoryInterface $honorRep)
    {
        $this->honorRep = $honorRep;
    }

    public function __invoke(Request $request)
    {
        $user_id = Auth::user()->id;

        $honors = $this->honorRep->paginateForUser($user_id);

        return view('admin.honors.paginate', [
            'honors' => $honors,
            'isProfile' => true
        ]);
    }
}
