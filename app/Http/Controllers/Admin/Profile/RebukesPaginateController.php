<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RebukeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RebukesPaginateController extends Controller
{
    public function __invoke(Request $request, RebukeRepositoryInterface $rebukeRepository)
    {
        $user_id = Auth::user()->id;
        $rebukes = $rebukeRepository->paginateForUser($user_id);

        return view('admin.rebukes.paginate', [
            'rebukes' => $rebukes,
            'isProfile' => true
        ]);
    }
}
