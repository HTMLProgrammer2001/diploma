<?php

namespace App\Http\Controllers\Admin\Import;

use App\Exports\QualificationsExampleExporter;
use App\Http\Controllers\Controller;
use App\Imports\QualificationsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QualificationsImportController extends Controller
{
    public function getImport(){
        return view('admin.qualifications.import');
    }

    public function postImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new QualificationsImport(), request()->file('file'));

        return redirect()->back()->with('successMsg', 'Дані імпортовано');
    }

    public function getExample(){
        return Excel::download(new QualificationsExampleExporter(), 'qualifications.xlsx');
    }
}
