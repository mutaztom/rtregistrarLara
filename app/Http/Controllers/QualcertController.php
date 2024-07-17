<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return $respond->write("nofile found");
    }
}
