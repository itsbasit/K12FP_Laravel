<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\helper;
use App\Models\admin\States;
use DataTables;




class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = States::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="states/'.$row->id.'/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>';
                           $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

      return view('dashboard.pages.admin.states.states');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('dashboard.pages.admin.states.createState');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state = new States;
        $state->stateName = $request->stateName;
        $state->save();
        toastr()->success('Record inserted Successfully');
        return redirect('admin/states');
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
    $data = States::find($id);
    return view('dashboard.pages.admin.states.editState',compact('data'));
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
        // try {
            $state = States::find($id);
            $state->stateName = $request->stateName;
            $state->update();
            toastr()->success('Record Updated Successfully');
            return redirect('admin/states');
        // } catch (\Throwable $th) {
        //     echo "something went wrong";
        //     // toastr()->error('Something went wrong');
        //     // return redirect('admin/states');
        // }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(states $state)
    {
        $state->delete();
        return response()->json("success");
    }
}
