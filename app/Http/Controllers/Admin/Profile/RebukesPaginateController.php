<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RebukesPaginateController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $rebukes = $user->rebukes()->paginate(env('PAGINATE_SIZE', 10));

        return view('admin.rebukes.paginate', [
            'rebukes' => $rebukes,
            'isProfile' => true
        ]);
    }
}
