<?php

namespace App\Http\Controllers\fm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fm\HighStudentsModel;
use App\Models\admin\Schools;
use App\Http\Requests\StoreHighStudentsRequest;
use DataTables;
use Validator;
use Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HighStudentsModel::where('added_by',\Auth::user()->id)->select('high_students.*', 'schools.schoolName')
            ->join('schools', 'high_students.school', '=', 'schools.id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="students/'.$row->id.'/edit" class="btn btn-primary btn-xs mx-1"><i class="fa fa-pencil"></i></a>';
                        $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard.pages.fm.high_students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.fm.high_students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHighStudentsRequest $request)
    {
        $validated = $request->validated();

        try {
        $user = HighStudentsModel::where('added_by',Auth::user()->id)->where('email',$request->email)->first();
        if($user)
        {
            toastr()->error('You have already added the Student with this Email!');
            return redirect()->back(); 
        } else {
            HighStudentsModel::create(array_merge($request->validated(), ['added_by' => Auth::user()->id]));
            toastr()->success('Record inserted Successfully');
            return redirect('fm/students');
        }
        
        } catch (\Throwable $th) {
        toastr()->error($th->getMessage());
        return redirect()->back();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = HighStudentsModel::where('high_students.id',$id)->select('schools.schoolName','schools.id','high_students.*')
        ->join('schools', 'high_students.school', '=', 'schools.id')->first();
        return view('dashboard.pages.fm.high_students.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHighStudentsRequest $request, $id)
    {
        $data = HighStudentsModel::find($id);
        $data->update($request->validated());
        toastr()->success('Record Updated Successfully');
        return redirect('fm/students');
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
            HighStudentsModel::where('id', $id)->delete();
            return response()->json("success");
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
