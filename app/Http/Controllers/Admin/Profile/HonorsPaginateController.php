<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HonorsPaginateController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $honors = $user->honors()->paginate(env('PAGINATE_SIZE', 10));

        return view('admin.honors.paginate', compact('honors'));
    }
}
