<?php

namespace App\Http\Controllers\fm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fm\FundraisersModel;
use App\Models\admin\States;
use App\Models\admin\Counties;
use App\Models\admin\District;
use App\Models\admin\Schools;
use Validator;
use DataTables;
class FundraisersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        
        if ($request->ajax()) {
            $data = FundraisersModel::where('user_id',\Auth::user()->id)->select('fundraisers.*', 'schools.schoolName')
            ->leftJoin('schools', 'fundraisers.school', '=', 'schools.id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        // $btn = '<a href="fund_raisers/'.$row->id.'/edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>';
                        $btn = '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard.pages.fm.fundraiser.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = States::get();
        return view('dashboard.pages.fm.fundraiser.createFundraiser',compact('states'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'color' => 'required',
            'logo' => 'required|mimes:jpeg,png,jpg,gif',
            'school' => 'required',
            'money_raising_for' => 'required',
            'total_goal' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
    
            $logoName = 'fundraiser'. time().'.'.$request->logo->extension();  
            $request->logo->move(public_path('uploads'), $logoName);

            $data = new FundraisersModel;
            $data->name = $request->name;
            $data->color = $request->color;
            $data->logo = $logoName;
            $data->user_id = \Auth::user()->id;
            $data->school = $request->school;
            $data->money_raising_for = $request->money_raising_for;
            $data->total_goal = $request->total_goal;
            $data->save();
            toastr()->success('Fundraiser Created Successfully');
            return redirect('fm/fund_raisers');
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
      echo "Calling". $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = FundraisersModel::find($id);
        return view('dashboard.pages.fm.fundraiser.editFundraiser', compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $image = FundraisersModel::find($id);
            unlink("uploads/".$image->logo);
            FundraisersModel::where('id', $id)->delete();
            return response()->json("success");
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
}