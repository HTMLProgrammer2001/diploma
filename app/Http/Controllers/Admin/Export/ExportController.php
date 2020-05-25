<?php

namespace App\Http\Controllers\Admin\Export;

use App\Exports\Export;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __invoke(Request $request)
    {
        return Excel::download(new Export(), 'report.xlsx');
    }
}
