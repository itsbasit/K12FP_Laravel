<?php

namespace App\Http\Controllers\fm\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fm\FundraiserPagesModel;
use App\Models\fm\FundraisersModel;
use App\Models\fm\StudentsModel;
use Illuminate\Support\Str;
use DataTables;
use Validator;

class FundraiserPagesController extends Controller
{
    public function index(Request $request)
    {
   
        if ($request->ajax()) {
            $data = FundraiserPagesModel::where('created_by',\Auth::user()->id)
            ->select('students.name as studentName','schools.schoolName','fundraisers.name','fundraisers.money_raising_for','fundraisers.total_goal','pages.*')
            ->leftJoin('fundraisers', 'fundraisers.id', '=', 'pages.fundraiser')
            ->leftJoin('schools', 'schools.id', '=', 'fundraisers.school')
            ->leftJoin('students', 'students.id', '=', 'pages.student')
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->student != null)
                        {
                            $btn = '<a href="student/'.$row->id.'/edit" class="btn btn-primary btn-xs mx-1"><i class="fa fa-pencil"></i></a>';
                        } else {
                            $btn = '<a href="main/'.$row->id.'/edit" class="btn btn-primary btn-xs mx-1"><i class="fa fa-pencil"></i></a>';
                        }
                        $btn .= '<a href="/fund/'.$row->slug.'" target="/blank" class="btn btn-primary btn-xs mx-1"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a data-id="'.$row->id.'" class="delete btn btn-danger btn-xs" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('dashboard.pages.fm.pages.index');
    }


    public function createMainPage()
    {
        
        $fundraisers = FundraisersModel::get();
        return view('dashboard.pages.fm.pages.main.create', compact('fundraisers'));
    }


    public function StoreMainPage(Request $request)
    {
        try {
            if(empty($request->featured_type) || $request->featured_type =="image")
        {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_image' => 'required',
            ]);  
        } else {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_video' => 'required',
            ]);
        }
        

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
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
        $page->fundraiser = $request->fundraiser;
        $page->slug = $request->slug;
        $page->student_goal = $request->student_goal;
        $page->team = $request->team;
        $page->content = $request->content;
        $page->created_by = \Auth::user()->id;
        $page->cover_type = $request->featured_type;
        $page->cover_url = $featured_image;

        $page->save();
        toastr()->success('Page Published Successfully');
        return redirect('fm/pages');
        }
        } catch (\Throwable $th) {
            
        toastr()->error($th->getMessage());
        return redirect()->back();
        }
        
    }

    public function editMainPage($id)
    {
        $data = FundraiserPagesModel::find($id);
        $fundraisers = FundraisersModel::get();
        $students = StudentsModel::get();
        return view('dashboard.pages.fm.pages.main.edit', compact('data','fundraisers','students'));
    }


    public function updateMainPage(Request $request, $id)
    {
        try {
            if(empty($request->featured_type) || $request->featured_type =="image")
        {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_image' => 'required',
            ]);  
        } else {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_video' => 'required',
            ]);
        }
        

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
        $page = FundraiserPagesModel::find($id);

        if($request->featured_image != NULL)
        {
        $featured_image = time().'.'.$request->featured_image
        ->extension();
        $request->featured_image
        ->move(public_path('uploads/pages'), $featured_image);
        } else {
            $featured_image = $request->featured_video;
        }
        $page->fundraiser = $request->fundraiser;
        $page->slug = $request->slug;
        $page->student_goal = $request->student_goal;
        $page->team = $request->team;
        $page->content = $request->content;
        $page->created_by = \Auth::user()->id;
        $page->cover_type = $request->featured_type;
        $page->cover_url = $featured_image;

        $page->save();
        toastr()->success('Page Updated Successfully');
        return redirect('fm/pages');
        }
        } catch (\Throwable $th) {
            
        toastr()->error($th->getMessage());
        return redirect()->back();
        }
    }



    public function createStudentPage()
    {
        $fundraisers = FundraisersModel::get();
        $students = StudentsModel::get();
        return view('dashboard.pages.fm.pages.student.create', compact('fundraisers','students'));
    }


    public function StoreStudentPage(Request $request)
    {

        try {
            if(empty($request->featured_type) || $request->featured_type =="image")
        {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'student' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_image' => 'required',
            ]);  
        } else {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'student' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_video' => 'required',
            ]);
        }
        

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
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
        $page->fundraiser = $request->fundraiser;
        $page->student = $request->student;
        $page->slug = $request->slug;
        $page->student_goal = $request->student_goal;
        $page->team = $request->team;
        $page->content = $request->content;
        $page->created_by = \Auth::user()->id;
        $page->cover_type = $request->featured_type;
        $page->cover_url = $featured_image;

        $page->save();
        toastr()->success('Page Published Successfully');
        return redirect('fm/pages');
        }
        } catch (\Throwable $th) {
            
        toastr()->error($th->getMessage());
        return redirect()->back();
        }
    }

    public function editStudentPage($id)
    {
        $data = FundraiserPagesModel::find($id);
        $fundraisers = FundraisersModel::get();
        $students = StudentsModel::get();
        return view('dashboard.pages.fm.pages.student.edit',compact('data','fundraisers','students'));
    }


    public function updateStudentPage(Request $request, $id)
    {
        try {
            if(empty($request->featured_type) || $request->featured_type =="image")
        {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'student' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_image' => 'required',
            ]);  
        } else {
            $validator = Validator::make($request->all(), [
                'fundraiser' => 'required',
                'student' => 'required',
                'team' => 'required',
                'slug' => 'required',
                'student_goal' => 'required',
                'content' => 'required',
                'featured_video' => 'required',
            ]);
        }
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            $page =  FundraiserPagesModel::find($id);
        if($request->featured_image != NULL)
        {
        $featured_image = time().'.'.$request->featured_image
        ->extension();
        $request->featured_image
        ->move(public_path('uploads/pages'), $featured_image);
        } else {
            $featured_image = $request->featured_video;
        }
        $page->fundraiser = $request->fundraiser;
        $page->student = $request->student;
        $page->slug = $request->slug;
        $page->student_goal = $request->student_goal;
        $page->team = $request->team;
        $page->content = $request->content;
        $page->created_by = \Auth::user()->id;
        $page->cover_type = $request->featured_type;
        $page->cover_url = $featured_image;

        $page->save();
        toastr()->success('Page Published Successfully');
        return redirect('fm/pages');
        }
        } catch (\Throwable $th) {
            
        toastr()->error($th->getMessage());
        return redirect()->back();
        }

    }




    public function destroy($id)
    {
        try {
            FundraiserPagesModel::where('id', $id)->delete();
            return response()->json("success");
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }
}
