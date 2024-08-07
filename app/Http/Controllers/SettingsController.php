<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tblsystemoption;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    //
    public function create(){
        $optionlist=Tblsystemoption::select()->get();
        $opdat=[];
        $optd['optionlist']=$optionlist;
        //dd($optionlist);
        foreach($optionlist as $option){
            $tbl=$option->tblname;
            $vals=DB::table($tbl)->get();
            $opdat[$tbl]=$vals;
        }
        return view('admin.settings',['optionlist'=>$optionlist,'opdat'=>$opdat]);
    }
    //save settings
    public function store(Request $request){
        //
    }
    public function edit(Request $request){
        //save form data into option
        $id=$request->get('itemid');
        $tbl=$request->get('tbl');
        DB::table($tbl)->where('id',$id)->update(['item'=>$request->get('item')
        ,'aritem'=>$request->get('aritem')]);
        return redirect()->route('settings')->with('success','option updated');
    }
    public function delete(Request $request){
        $id=$request->get('rem_itemid');
        $tbl=$request->get('rem_tbl');
        DB::table($tbl)->where('id',$id)->delete();
        return redirect()->back()->with('success','option deleted');
    }
}