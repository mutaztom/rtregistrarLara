<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tblqualification;
use Illuminate\Support\Facades\Storage;
use App\Models\Tblqualtype;
use App\Models\Tblqualdegree;

class QualcertController extends Controller
{
    public function index(){
        $qual=new Tblqualification();
        return view('qualification',['qual'=>$qual,'qualtype'=>Tblqualification::all(),
    'qualdegree'=>Tblqualdegree::all()]); //
    }
    public function show(int $qualid){
        $qualifications=DB::table('tblqualification')->where('id',$qualid)->get();
        return view('qualification',compact(['qual'=>$qualifications]));
    }
    public function editQualification(Request $request){
        $qualid=$request->get('qualid');
        if($qualid>0)
        {
         if(!$request->hasfile('certificate') && Tblqualification::find($qualid)->pdf=='')
             return redirect()->back()->with('error', 'No file selected!');
        $update=DB::table('tblqualification')->where("id",$qualid)->update($request->except(['_tocket','csrf','command']));
         
        }
        else{
         $q=new Tblqualification();
         $empid=Auth()->user()->regid;
         $q->appid= $empid;
         $q->empid=$empid;
         if(!$request->hasfile('certificate'))
             return redirect()->back()->with('error', 'No file selected!');
         //write data to database
         DB::table('qualifications')->create($request->except(['_token','csrf','command']));
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
    }
    //show certificate
    public function showcert($qualid){
      $cert=DB::table('tblqualification')->where('id',$qualid)->first()->pdf;
      return view('qualcert',["cert"=>$cert]);
    }
    //view form to upload certificate
    public function viewcert($id){
        return view('qualcertificate',["qualid"=>$id]);
    }
    public function certfile($qualid){
        $cert=DB::table('tblqualification')->where('id',$qualid)->first()->pdf;
        return $pdf;
    }
    public function modify($qualid){
        $qual=DB::table('tblqualification')->where('id',$qualid)->first();
        return redirect()->route('regorder')->with('editqual',["editqual"=>$qual]);
    }
    public function delete($qualid){
        DB::table('tblqualification')->where('id',$qualid)->delete();
        return redirect()->route('regorder')->with('success', 'Qualification deleted successfully!');
    }
    public function deletepdf($qualid){
     try   {//get the pdf path
        $pdf=DB::table('tblqualification')->where('id',$qualid)->first()->pdf;
        //delete the pdf from the storage
        Storage::delete('certs/'.$pdf);
        Tblqualification::where('id', $qualid)->update(['pdf' => null]);
        return response('attachment deleted successfully!',200)
        ->header('Content-Type', 'text/plain');
    }catch(Exception $e){
        return response('Error deleting attachment: '.$e->getMessage(),500)
        ->header('Content-Type', 'text/plain');
    }
}
}
