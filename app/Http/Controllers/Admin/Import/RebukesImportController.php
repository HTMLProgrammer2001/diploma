<?php

namespace App\Http\Controllers\Admin\Import;

use App\Exports\HonorsExampleExporter;
use App\Exports\RebukesExampleExporter;
use App\Http\Controllers\Controller;
use App\Imports\HonorsImport;
use App\Imports\RebukesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RebukesImportController extends Controller
{
    public function getImport(){
        return view('admin.rebukes.import');
    }

    public function postImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new RebukesImport(),request()->file('file'));

        return redirect()->back()->with('successMsg', 'Дані імпортовано');
    }

    public function getExample(){
        return Excel::download(new RebukesExampleExporter(),
            'rebukes.xlsx');
    }
}
