<?php

namespace App\Http\Controllers\Admin\Import;

use App\Exports\PublicationsExampleExporter;
use App\Http\Controllers\Controller;
use App\Imports\PublicationsImport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PublicationsImportController extends Controller
{
    public function getImport(){
        return view('admin.publications.import');
    }

    public function postImport(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new PublicationsImport(),request()->file('file'));

        session()->flash('imported', true);
        return redirect()->back();
    }

    public function getExample(){
        return Excel::download(new PublicationsExampleExporter(),
            'publications.xlsx');
    }
}
