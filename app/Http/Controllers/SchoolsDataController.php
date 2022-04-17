<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SchoolsDataImport;


class SchoolsDataController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.admin.importschooldata');   
    }

    public function store(Request $request)
    {

    $path = $request->file('file');

        Excel::import(new SchoolsDataImport(), $path);
        toastr()->success('Record imported Successfully!');
        return redirect()->back();
    }
}
