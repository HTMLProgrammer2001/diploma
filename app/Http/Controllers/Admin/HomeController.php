<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\InternshipRepositoryInterface;
use App\Repositories\Interfaces\QualificationRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('admin.index');
    }
}
