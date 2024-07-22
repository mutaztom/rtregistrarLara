<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tblqualification;


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
}
