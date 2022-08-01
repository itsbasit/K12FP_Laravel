<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FmModel;
use App\Rules\MatchOldPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index()
    {
        $userExists = FmModel::where("user_id", \Auth::user()->id)->first();
        if(empty($userExists) || $userExists == null)
        {
            $type = 'Create';
        } else{
            $type = 'Update';
        }
        $data = User::find(\Auth::user()->id)
        ->select('fund_manager.*','users.*')
        ->leftJoin('fund_manager','fund_manager.user_id','=','users.id')
        ->first();
        
        return view('dashboard.pages.profile.index', compact('data', 'type'));
    }


    public function complete_profile(Request $request)
    {
        $this->validate($request, [
            'position' => 'required',
            'orgType' => 'required',
            'org_name' => 'required',
            'streetAddress' => 'required',
            'orgState' => 'required',
            'zipCode' => 'required',
        ]);

        $fm = new FmModel;
        $fm->position = $request->position;
        $fm->user_id = \Auth::user()->id;
        $fm->orgType = $request->orgType;
        $fm->org_name = $request->org_name;
        $fm->streetAddress = $request->streetAddress;
        $fm->orgState = $request->orgState;
        $fm->zipCode = $request->zipCode;
        $fm->save();
        
        $user = User::find(\Auth::user()->id);
        $user->update(['profile_completed' => 1]);
    
        toastr()->success('Profile Updated Successfully!');
        return redirect()->back();
    }

    public function update_profile(Request $request)
    {
        $this->validate($request, [
            'position' => 'required',
            'orgType' => 'required',
            'org_name' => 'required',
            'streetAddress' => 'required',
            'orgState' => 'required',
            'zipCode' => 'required',
        ]);

        $fm = FmModel::where("user_id",\Auth::user()->id)
        ->update(
            [
                "position" =>  $request->position,
                "user_id" => \Auth::user()->id,
                "orgType" => $request->orgType,
                "org_name" => $request->org_name,
                "streetAddress" => $request->streetAddress,
                "orgState" => $request->orgState,
                "zipCode" => $request->zipCode
            ]
        );
        
        $user = User::find(\Auth::user()->id);
        $user->update(['profile_completed' => 1]);
    
        toastr()->success('Profile Updated Successfully!');
        return redirect()->back();
    }

    public function updateDp(Request $request)
    {
        $dpName = 'profile'. time().'.'.$request->dp->extension();  
        $request->dp->move(public_path('uploads'), $dpName);
        $user = User::find(\Auth::user()->id);
        $user->update(['dp' => $dpName]);

        if(\Auth::user()->dp != null)
        {
            unlink("uploads/".''.\Auth::user()->dp);
        }
    
        toastr()->success('Profile Picture Uploaded!');
        return redirect()->back();
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(\Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        toastr()->success('Password Updated!');
        return redirect()->back();
    }
}
