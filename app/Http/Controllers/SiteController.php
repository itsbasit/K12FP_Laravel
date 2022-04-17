<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\FmModel;
use Illuminate\Support\Facades\Facade;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class SiteController extends Controller
{
   public function index()
   {
       return view('home');
   }

   public function store_fm(Request $request)
   {

    
    $user = new User;
    $fm = new FmModel;


    $this->validate($request, [
        'position' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'orgType' => 'required',
        'org_name' => 'required',
        'streetAddress' => 'required',
        'orgState' => 'required',
        'zipCode' => 'required',
    ]);

    $user->email = $request->email;
    $user->name = $request->first_name .' '. $request->last_name;
    $user->password = Hash::make($request->password);
    $user->assignRole('fm');
    $user->save();

    $fm->position = $request->position;
    $fm->user_id = $user->id;
    $fm->first_name = $request->first_name;
    $fm->last_name = $request->last_name;
    $fm->email = $request->email;
    $fm->orgType = $request->orgType;
    $fm->org_name = $request->org_name;
    $fm->streetAddress = $request->streetAddress;
    $fm->orgState = $request->orgState;
    $fm->zipCode = $request->zipCode;
    $fm->save();
    toastr()->success('Account created Successfully!');
    return redirect()->back();

   }
}
