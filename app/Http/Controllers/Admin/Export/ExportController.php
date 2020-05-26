<?php

namespace App\Http\Controllers\Admin\Export;

use App\Exports\Export;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function __invoke(Request $request)
    {
        $name = '';

        while(strlen($name) != 10)
            $name.= rand(0, 9);

        $name.= '.xlsx';

        Excel::store(new Export(UsersController::createRule($request->input())), './public/' . $name);

        return '/storage/' . $name;
    }
}
