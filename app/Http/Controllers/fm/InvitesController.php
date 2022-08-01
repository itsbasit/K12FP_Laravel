<?php

namespace App\Http\Controllers\fm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fm\StudentsModel;
use App\Models\fm\Invites;
use App\Mail\InviteEmail;
use Mail;
use DataTables;

class InvitesController extends Controller
{
    public function index()
    {
        $students = StudentsModel::select("parents.*","students.*")
        ->leftJoin("parents","parents.student","=","students.id")
        ->get();
        
        return view("dashboard.pages.fm.invites.index", compact('students'));
    }

    public function invitedStudents(Request $request)
    {
        if ($request->ajax()) {
            $data = Invites::where('invited_by',\Auth::user()->id)
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
    }

    public function submitQueue(Request $request)
    {
        
        try {
        foreach($request->email as $email)
        {
            $data = new Invites;
            $data->email = $email;
            $data->invited_by = \Auth::user()->id;
            $data->save();
            toastr()->success("Invitations Sent Successfully!");
            return redirect('fm/invites');
        }
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }

    public function sendInvite(Request $request)
    {
        try {

        $user = Invites::where("status",'=','Pending')->first();
        $msg = "You are invited to Sign Up for k12fp";
        Mail::to($user->email)->send(new InviteEmail($msg));
        Invites::where('id', $user->id)
        ->update(['status' => 'Sent']);
        
        } catch (\Throwable $th) {
           echo $th->getMessage();
        }
        
  
    }

    
}
