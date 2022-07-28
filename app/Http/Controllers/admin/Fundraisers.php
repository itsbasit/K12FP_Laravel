<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fm\FundraisersModel;
use DataTables;
class Fundraisers extends Controller
{
   
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = FundraisersModel::select('schools.schoolName','fundraisers.*')
            ->leftJoin('schools', 'schools.id', '=', 'fundraisers.school')
            ->leftJoin('users', 'users.id', '=', 'fundraisers.user_id')
            ->get();
    
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="fundraisers/'.$row->id.'/view" class="btn mx-1 btn-primary btn-xs"><i class="fa fa-eye"></i></a>';
                if($row->status == 'Closed')
                {
                    $btn .= '<a data-id="'.$row->id.'" class="unblock btn btn-warning text-white mx-1 btn-xs" href="javascript:void(0)"><i class="fa fa-unlock"></i></a>';
                } else {
                    $btn .= '<a data-id="'.$row->id.'" class="block btn btn-warning text-white mx-1 btn-xs" href="javascript:void(0)"><i class="fa fa-lock"></i></a>';
                }
                
                $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
               
                return $btn;
            })
            
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('Y-m-d'); // human readable format
              })
            ->editColumn('ended_at', function ($request) {
            return $request->ended_at == null ? 'Not ended yet' : $request->ended_at->format('Y-m-d'); // human readable format
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('dashboard.pages.admin.fundraiser.index');
    }


    // details fundraiser

    public function view_fundraiser($id)
    {
        $data = FundraisersModel::where('fundraisers.id',$id)->select("schools.schoolName",'users.name as userName','fundraisers.*')
        ->join('schools','schools.id','=','fundraisers.school')
        ->join('users','users.id','=','fundraisers.user_id')
        ->first();
        return view('dashboard.pages.admin.fundraiser.view', compact('data'));
    }


    public function block($id)
    {
        try {
        FundraisersModel::where('id', $id)
        ->update(['status' => 'Closed']);
        return response()->json("success");
        } catch (\Throwable $th) {
        toastr()->error($th->getMessage());
        return redirect()->back();
        }
    }

    public function unblock($id)
    {
        try {
        FundraisersModel::where('id', $id)
        ->update(['status' => 'Active']);
        return response()->json("success");
        } catch (\Throwable $th) {
        toastr()->error($th->getMessage());
        return redirect()->back();
        }
    }


    public function delete($id)
    {
    try {
        FundraisersModel::where('id', $id)->delete();
        return response()->json("success");
    } catch (\Throwable $th) {
        toastr()->error($th->getMessage());
        return redirect()->back();
    }
    }
}
