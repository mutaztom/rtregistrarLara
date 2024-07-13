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
    // var $cities=Tblcity::class;
    // var $nationalities=Tblnationality::class;
    // var $countries=Tblnationality::class;
    // var $engclass=Tblengclass::class;
    // var $jobs=Tbljob::class;
    // var $idtypes=Tblidcardtype::class;
    // var $engdegree=Tblengdegree::class;
    // var $membership=Tblmembership::class;
    // var $qualification=null;
    // var $qualtype=null;
    // var $qualdegree=null;
    // var $title="regform";


  public function registerrequest(Request $request){
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
     //process form data
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
        public function saveQualification(Request $request){
         //save data to database
         $q=Tblqualification::class;
         $q->item=request->get('entity');
         $q->empid=866;
         $q->degree=request->get('degree');
         $q->entity=request->get('entity');
         $q->startdate=request->get('startdate');
         $q->enddate=request->get('enddate');
         $q->save();
        }
        public function saveorder(Request $request){
         if($request->get('command')=='saveorder'){
            //save data to database

         }else if($request->get('command')=='savequal'){
         saveQualification($request);
          return Route::back()->with('success', 'Qualification saved successfully!');
        }
      }
}
