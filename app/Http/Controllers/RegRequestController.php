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
use Illuminate\Http\Request\filesystem;
use Illuminate\Support\Facades\Storage;

class RegRequestController extends Controller
{
public static function lockups():Array{
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
    
    $loarray=["cities"=>$cities,
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
      "entity"=>"University",
  ];
  return $loarray;
}

  public function registerrequest(Request $request){
  
     //process form data
      return view('regorder',RegRequestController::lockups());

   }
        public function uploadphoto($request){
         //upload photo of registrant
         $regid=Auth()->user()->id;
        if($request->hasfile('regphoto')){
          $path=$request->file('regphoto');
          $ext = $path->extension();
          Storage::delete('photo_'.$regid.'.'.$ext);
          $path->storeAs('public/photos','photo_'.$regid.'.'.$ext);
          Auth()->user()->avatar='photo_'.$regid.'.'.$ext;
          Auth()->user()->save();
          return redirect()->route('regorder')->with('success', 'Photo uploaded successfully!');
        }else{
          return redirect()->back()->with('error', 'Please select a photo!');
        }
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
          $command=$request->get('command');
         if($command=='saveorder'){
            //save data to database
            return redirect()->route('regorder')->with('success', 'Qualification saved successfully!');
         }else if(str_starts_with($command,'savequal')){
          $this->saveQualification($request);
          //return redirect()->back()->with('success', 'Qualification saved successfully!');
          return $this->registerrequest($request);
        }else if(str_starts_with($command,'viewqual')){
          $qualid=explode('_',$command)[1];
          $qual=Tblqualification::find($qualid);
          return $this->registerrequest($request);
        }else if(str_starts_with($command,'modifyqual'))
        {
          $qualid=explode('_',$command)[1];
          $qual=Tblqualification::find($qualid);
          //return view('qualform',["qual"=>$qual]);
          //return redirect()->route('regorder')->with('success', 'Qualification saved successfully!');
          return $this->registerrequest($request);
        }
        else if(str_starts_with($command,'deletequal'))
        {
          $qualid=explode('_',$command)[1];
            $this->deletequalification($request->get('qualid'));
            //return redirect()->back()->with('success', 'Qualification deleted successfully!');
            return redirect()->back();
          }
          else if(str_starts_with($command,'uploadcert')){
            $qualid=explode('_',$command)[1];
            //upload certificate of registrant
            if($request->hasfile('pdf')){
              $ext=$request->file('pdf')->getClientOriginalExtension();
              if($ext!='pdf'){
                return redirect()->back()->with('error', 'Only PDF files are allowed!');
              }
              $path = $request->file('pdf')->storeAs('cert',"certificate_". str($qualid) .$ext);
              $qual=Tblqualification::find($qualid);
              $qual->pdf ="certificate_". str($qualid) .$ext;
              $qual->save();
              return redirect()->back()->with('success', 'Photo uploaded successfully!');
            }else{
              return redirect()->back()->with('error', 'No file selected!');
            }
            //upload photo of registrant
          }
          else if($command=='uploadphoto')
            {
              return $this->uploadphoto($request);
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
