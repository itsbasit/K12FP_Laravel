<?php

namespace App\Http\Controllers\fm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Counties;
use App\Models\admin\District;
use App\Models\admin\Schools;

class FetchData extends Controller
{
  public function getCounty(Request $request)
  {
      $stateName =  $request->stateName;
      $county = Counties::where('stateName', $stateName)->get();
      echo json_encode($county);
  }

  public function getDistricts(Request $request)
  {
      $countyName =  $request->countyName;
      $districts = District::where('countyName', $countyName)->get();
      echo json_encode($districts);
  }

  public function getSchools(Request $request)
  {
      $districtName =  $request->districtName;
      $schools = Schools::where('districtName', $districtName)->get();
      echo json_encode($schools);
  }

  public function getSchoolByName(Request $request)
  {
    $search = $request->search;
    if($search =='')
    {
        $schools = Schools::orderby('schoolName','asc')->select('id','schoolName')->limit(5)->get();
    } else {
       $schools= Schools::orderby('schoolName','asc')->select('id','schoolName')->where('schoolName', 'like', '%' .$search . '%')->limit(5)->get();
    }

    $response = array();
      foreach($schools as $school){
         $response[] = array(
              "id"=>$school->id,
              "text"=>$school->schoolName
         );
      }
      return response()->json($response); 
    
  }
}