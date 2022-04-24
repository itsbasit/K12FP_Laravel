<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Users;
use DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Users::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        //    $btn = '<a href="users/'.$row->id.'/block" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>';
                           $btn = '<a data-id="'.$row->id.'" class="block btn btn-warning m-3 btn-xs" href="javascript:void(0)"><i class="fa fa-lock"></i></a>';
                           $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dashboard.pages.admin.users.index');
    }

    public function block(Request $req)
    {
        $user = Users::find($id);
        $user->status = "block";
        $user->update();
        return response()->json("success");
    }

    public function destroy()
    {
        echo "destroy calling";
    }
}