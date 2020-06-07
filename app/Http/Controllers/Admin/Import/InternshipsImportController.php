<?php

namespace App\Http\Controllers\Admin\Import;

use App\Exports\InternshipsExampleExporter;
use App\Http\Controllers\Controller;
use App\Imports\InternshipsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InternshipsImportController extends Controller
{
    public function getImport(){
        return view('admin.internships.import');
    }

    public function postImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new InternshipsImport(),request()->file('file'));

        session()->flash('imported', true);
        return redirect()->back();
    }

    public function getExample(){
        return Excel::download(new InternshipsExampleExporter(),
            'internships.xlsx');
    }
}
