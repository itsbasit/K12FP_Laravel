<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\States;
use App\Models\admin\Counties;
use DataTables;


class CountiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Counties::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="counties/'.$row->id.'/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>';
                           $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

      return view('dashboard.pages.admin.counties.counties');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = States::get();
        return view('dashboard.pages.admin.counties.createCounty', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = new Counties;
        $data->stateName = $request->stateName;
        $data->countyName = $request->countyName;
        $data->save();
        toastr()->success('Record inserted Successfully');
        return redirect('admin/counties');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage())->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $county = Counties::find($id);
    $states = States::get();
    return view('dashboard.pages.admin.counties.editCounty',compact('county','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $county = Counties::find($id);
        $county->stateName = $request->stateName;
        $county->countyName = $request->countyName;
        $county->update();
        toastr()->success('Record updated Successfully');
        return redirect('admin/counties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Counties::where('id', $id)->delete();
        
        return response()->json("success");
    }
}
