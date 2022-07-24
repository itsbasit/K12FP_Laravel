<?php

namespace App\Http\Controllers\fm;

use App\Http\Controllers\Controller;
use App\Models\fm\FundraiserPagesModel;
use App\Models\fm\FundraisersModel;
use App\Models\fm\StudentsModel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFrPagesRequest;
use Illuminate\Support\Str;
use DataTables;
use Validator;



class FundraiserPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FundraiserPagesModel::where('created_by',\Auth::user()->id)
            ->select('students.name as studentName','schools.schoolName','fundraisers.name','fundraisers.money_raising_for','fundraisers.total_goal','fundraisers_pages.*')
            ->leftJoin('fundraisers', 'fundraisers.id', '=', 'fundraisers_pages.fundraiser')
            ->leftJoin('schools', 'schools.id', '=', 'fundraisers.school')
            ->leftJoin('students', 'students.id', '=', 'fundraisers_pages.student')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="fundraisers_pages/'.$row->id.'/edit" class="btn btn-primary btn-xs mx-1"><i class="fa fa-pencil"></i></a>';
                        $btn .= '<a href="/fund/'.$row->slug.'" target="/blank" class="btn btn-primary btn-xs mx-1"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard.pages.fm.fundraisers_pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
       
        $fundraisers = FundraisersModel::get();
        $students = StudentsModel::get();
        return view('dashboard.pages.fm.fundraisers_pages.create', compact('fundraisers','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // if($request->featured_type == 'image')
        // {
        //     $validator = Validator::make($request->all(), [
        //         'title' => 'required',
        //         'page_type' => 'required',
        //         'fundraiser' => 'sometimes|required',
        //         'student' => 'sometimes|required',
        //         'team' => 'required',
        //         'student_goal' => 'required',
        //         'content' => 'required',
        //         'featured_image' => 'required',
        //     ]);
        // } else{
        //     $validator = Validator::make($request->all(), [
        //         'title' => 'required',
        //         'page_type' => 'required',
        //         'fundraiser' => 'sometimes|required',
        //         'student' => 'sometimes|required',
        //         'team' => 'required',
        //         'student_goal' => 'required',
        //         'content' => 'required',
        //         'featured_video' => 'required',  
        //     ]);
        // }
        

        // if ($validator->fails()) {

        //     return redirect()->back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // } else 
        // {
            
            
            $page = new FundraiserPagesModel;
            if($request->featured_image != NULL)
            {
            $featured_image = time().'.'.$request->featured_image
            ->extension();
            $request->featured_image
            ->move(public_path('uploads/pages'), $featured_image);
            } else {
                $featured_image = $request->featured_video;
            }
    
            $page->title = $request->title;
            $page->fundraiser = $request->fundraiser;
            if(!empty($page_type) || $page_type != 'main')
            {
                $page->student = $request->student;   
            }
            $page->student_goal = $request->student_goal;
            $page->team = $request->team;
            $page->content = $request->content;
            $page->created_by = \Auth::user()->id;
            $page->featured_image = $featured_image;
    
            $page->save();
            toastr()->success('Page Published Successfully');
            return redirect('fm/fundraisers_pages');
        // }
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
        $data = FundraiserPagesModel::find($id);
        $fundraisers = FundraisersModel::get();
        $students = StudentsModel::get();
        return view('dashboard.pages.fm.fundraisers_pages.edit', compact('data','fundraisers','students'));
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
        //
    }
}
