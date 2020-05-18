<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExampleExporter;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function getImport(){
        return view('admin.users.import');
    }

    public function postImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new UsersImport,request()->file('file'));

        return redirect()->back()->with('successMsg', 'Дані імпортовано');
    }

    public function getExample(){
        return Excel::download(new UsersExampleExporter(),
            'users.xlsx');
    }
}
