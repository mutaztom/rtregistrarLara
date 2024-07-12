<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tblcity;
use App\Models\Tblnationality;
use App\Models\Tbljob;
use App\Models\Tblengclass;
use App\Models\Tblidcardtype;
use App\Models\Tblengdegree;
use App\Models\Tblmembership;
use App\Models\Tblqualification;
use App\Models\Tblqualtype;

class RegRequestController extends Controller
{
   
   public function registerrequest(){
      $cities=Tblcity::select('item')->pluck('item')->toArray();
      $nationalities=Tblnationality::select('item')->pluck('item')->toArray();
      $countries=Tblnationality::select('item')->pluck('item')->toArray();
      $engclass=Tblengclass::select('item')->pluck('item')->toArray();
      $jobs=Tbljob::select('item')->pluck('item')->toArray();
      $idtypes=Tblidcardtype::select('item')->pluck('item')->toArray();
      $engdegree=Tblengdegree::select('item')->pluck('item')->toArray();
      $membership=Tblmembership::select('item')->pluck('item')->toArray();
      $qualification=Tblqualification::where('empid',866)->get();
      $qualtype=Tblqualtype::select('item')->pluck('item')->toArray();
      $qualdegree=Tblengdegree::select('item')->pluck('item')->toArray();

      return view('regorder',["cities"=>$cities,
    "nationalities"=>$nationalities,
      "countries"=>$countries,
      "jobs"=>$jobs,
      "engclass"=>$engclass,
      "engdegree"=>$engdegree,
      "idtypes"=>$idtypes,
      "title"=>"regform",
      "qualification"=>$qualification,
    "qualtype"=>$qualtype,
    "qualdegree"=>$qualdegree,
    "membership"=>$membership]);
   }
        public function uploadphoto(){
         //upload photo of registrant
        }
}
