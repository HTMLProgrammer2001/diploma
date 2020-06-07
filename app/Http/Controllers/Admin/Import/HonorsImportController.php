<?php

namespace App\Http\Controllers\Admin\Import;

use App\Exports\HonorsExampleExporter;
use App\Http\Controllers\Controller;
use App\Imports\HonorsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HonorsImportController extends Controller
{
    public function getImport(){
        return view('admin.honors.import');
    }

    public function postImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new HonorsImport(),request()->file('file'));

        session()->flash('imported', true);
        return redirect()->back();
    }

    public function getExample(){
        return Excel::download(new HonorsExampleExporter(),
            'honors.xlsx');
    }
}
