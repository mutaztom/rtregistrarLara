<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
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
use App\Models\Tblqualdegree;
use Carbon\Carbon;

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
   $qualdegree=Tblqualdegree::select('item')->pluck('item')->toArray();
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
    "membership"=>$membership,
  "startdate"=>Carbon::now(),
"enddate"=>Carbon::now(),
"entity"=>"University",]);

   }
        public function uploadphoto(){
         //upload photo of registrant
        }
        public function saveQualification(Request $request){
         //save data to database
         $empid=866;
         $q=new Tblqualification();
         $q->item=$request->get('entity');
         $q->degree=$request->get('degree');
        $q->entity=$request->get('entity');
        $q->startdate=$request->get(date('startdate'));
        $q->enddate=$request->get(date('enddate'));
        ///$q->insert($request->only(['entity','degree',date('startdate'),date('enddate')]));
         $q->appid= $empid;
         $q->empid= $empid;
        // $q->empid=$empid;
         $q->save();
         //redirect()->route('regorder')->with('success', 'Qualification saved successfully!');
         
        }
       
        public function saveorder(Request $request){
         if($request->get('command')=='saveorder'){
            //save data to database
            return redirect()->route('regorder')->with('success', 'Qualification saved successfully!');
         }else if($request->get('command')=='savequal'){
          $this->saveQualification($request);
          //return redirect()->back()->with('success', 'Qualification saved successfully!');
          return $this->registerrequest($request);
        }else if($request->get('command')=='viewqual'){
        }else if($request->get('command')=='modifyqual'){
        }else if($request->get('command')=='deletequal'){
            $this->deletequalification($request->get('qualid'));
            //return redirect()->back()->with('success', 'Qualification deleted successfully!');
            return redirect()->back();
          }
      }
      public function deletequalification($id){
        //delete data from database
        $q=Tblqualification::find($id);
        error_log("delete qualification: $id");
        //if($q){
          $q->delete();
        //}
      }
}
