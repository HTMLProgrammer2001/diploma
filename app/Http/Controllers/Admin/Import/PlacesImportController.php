<?php

namespace App\Http\Controllers\Admin\Import;

use App\Exports\PlacesExampleExporter;
use App\Http\Controllers\Controller;
use App\Imports\PlacesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PlacesImportController extends Controller
{
    public function getImport(){
        return view('admin.places.import');
    }

    public function postImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new PlacesImport(),request()->file('file'));

        return redirect()->back()->with('successMsg', 'Дані імпортовано');
    }

    public function getExample(){
        return Excel::download(new PlacesExampleExporter(),
            'places.xlsx');
    }
}
