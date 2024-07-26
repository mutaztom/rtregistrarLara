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
use App\Models\Tblregmembership;
use Carbon\Carbon;  
use Illuminate\Http\Request\filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Tblsociety;

class RegRequestController extends Controller
{
public static function lockups():Array{
    $cities=Tblcity::select('id','item')->get();
    $nationalities=Tblnationality::select('id','item')->get();
    $countries=Tblnationality::select('id','item')->get();
    $engclass=Tblengclass::select('id','item')->get();
    $jobs=Tbljob::select('id','item')->get();
    $idtypes=Tblidcardtype::select('id','item')->get();
    $engdegree=Tblengdegree::select('id','item')->get();
    $membership=Tblmembership::select('id','item')->get();
    $qualification=Tblqualification::where('empid',866)->get();
    $qualtype=Tblqualtype::select('id','item')->get();
    $qualdegree=Tblqualdegree::select('id','item')->get();
    $societies=Tblsociety::select('id','item')->get();
    
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
      "societies"=>$societies,
      "membertype"=>DB::table('tblmemberships')->select('id','item')->get(),
      "memberships"=>Tblregmembership::where('regid',  Auth()->user()->regid)->get(),
      "entity"=>"University",
  ];
  return $loarray;
}

  public function registerrequest(Request $request){
  
     //process form data
     $param=RegRequestController::lockups();
      return view('regorder',$param);
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
        
       
        public function saveorder(Request $request){
          $command=$request->get('command');
         if($command=='saveorder'){
            //save data to database
            return redirect()->route('regorder')->with('success', 'Qualification saved successfully!');
         }
         else if(str_starts_with($command,'savequal'))
         {
          $qualid=explode('_',$command)[1];
         if($qualid>0)
         {
          if(!$request->hasfile('certificate') && Tblqualification::find($qualid)->pdf=='')
              return redirect()->back()->with('error', 'No file selected!');
          $update=DB::table('tblqualification')->where("id",$qualid)->update
          (["qualtype"=>$request->get('qtype'),
            "degree"=>$request->get('degree'),
            "entity"=>$request->get('entity'),
            "startdate"=>$request->get('startdate'),
            "enddate"=>$request->get('enddate'),
            ]);
         }
         else{
          $q=new Tblqualification();
          $empid=Auth()->user()->regid;
          $q->appid= $empid;
          $q->empid=$empid;
          if(!$request->hasfile('certificate'))
              return redirect()->back()->with('error', 'No file selected!');
          //write data to database
          $q->item=$request->get('entity');
          $q->degree=$request->get('degree');
          $q->entity=$request->get('entity');
          $q->startdate=$request->get('startdate');
          $q->enddate=$request->get('enddate');
          $q->qualtype=$request->get('qtype');
          $q->save();
          $qualid=$q->id;
         }
         //upload certificate of registrant
         if($request->hasfile('certificate')){
            $ext=$request->file('certificate')->getClientOriginalExtension();
            $fname="certificate_". str($qualid).'.'.$ext;
            if($ext!='pdf'){
              return redirect()->back()->with('error', 'Only PDF files are allowed!');
            }
            $path = $request->file('certificate')->storeAs('public/certs',$fname);
              Tblqualification::where("id",$qualid)->update(["pdf"=>$fname]);
            return redirect()->route('regorder')->with('success', 'Certificate pdf uploaded successfully!');
          }
          else 
          {
            if($qualid<=0)
              return redirect()->route('regorder')->with('error', 'No file selected!');
            else
            return redirect()->route('regorder')->with('success', 'Qualification saved successfully.');
          }
          //upload photo of registrant
        }else if(str_starts_with($command,'viewqual')){
          $qualid=explode('_',$command)[1];
          $qual=Tblqualification::find($qualid);
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
            if($request->hasfile('certificate')){
              $ext=$request->file('certificate')->getClientOriginalExtension();
              $fname="certificate_". str($qualid).'.'.$ext;
              if($ext!='pdf'){
                return redirect()->back()->with('error', 'Only PDF files are allowed!');
              }
              $path = $request->file('certificate')->storeAs('public/certs',$fname);
              $qual=new Tblqualification();
              if($qualid>0)
              {
                Tblqualification::where($qualid)->update(["pdf"=>$fname]);
              }else{
                //if saving new qualification
                $qid=$this->saveQualification($request);
                $fname="certificate_". $qid.'.'.$ext;
                Tblqualification::where('id',$qid)->update(['pdf'=>$fname]);
              }
              
              return redirect()->route('regorder')->with('success', 'Certificate pdf uploaded successfully!');
            }else{
              return redirect()->route('regorder')->with('error', 'No file selected!');
            }
            //upload photo of registrant
        }else if(str_starts_with($command,'viewqual')){
          $qualid=explode('_',$command)[1];
          $qual=Tblqualification::find($qualid);
          return $this->registerrequest($request);
        }
        else if(str_starts_with($command,'deletequal'))
        {
          $qualid=explode('_',$command)[1];
            $this->deletequalification($request->get('qualid'));
            //return redirect()->back()->with('success', 'Qualification deleted successfully!');
            return redirect()->back();
          }
          else if($command=='uploadphoto')
            {
              return $this->uploadphoto($request);
            }
            else if($command=='createmembership'){
              $mm=new MembershipController();
              return $mm->create($request);
            }
            else if(str_starts_with($command,'updatemembership')){
              $id=explode('_',$command)[1];
              $mm=new MembershipController();
              return $mm->update($request,$id);
            }
            else if(str_starts_with($command,'removemembership')){
              $id=explode('_',$command)[1];
              $mm=new MembershipController();
              return $mm->destroy($id);
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
