<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tblqualification;
use Illuminate\Support\Facades\Storage;

class QualcertController extends Controller
{
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
