<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
