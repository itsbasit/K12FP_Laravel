<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\fm\FundraiserPagesModel;
use App\Models\Transactions;
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


   public function fundraiserPage($slug)
   {
    try {

    $data = FundraiserPagesModel::where("slug",'=',$slug)
    ->select('fundraisers.*','students.name as studentName','pages.*')
    ->leftJoin('fundraisers','fundraisers.id','=','pages.fundraiser')
    ->leftJoin('students','students.id','=','pages.student')
    ->get()->first();

    if($data)
    {
        if($data->student != null)
    {
        $testimonials = Transactions::where('student','=',$data->student)
        ->select('*')
        ->orderBy('created_at', 'DESC')
        ->get();
    } else {
        $testimonials = Transactions::where('fundraiser','=',$data->fundraiser)
        ->select('*')
        ->orderBy('created_at', 'DESC')
        ->get();
    }
    } else {
        return redirect('/');
    }
    

    } catch (\Throwable $th) {
        //throw $th;
    }
    return view('home', compact('data','testimonials'));
   }


   public function checkout(Request $request)
   {
    $params = $request->query->all();
    return view('checkout', compact('params'));
   }
}
