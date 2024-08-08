<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tblsystemoption;
use Illuminate\Support\Facades\DB;
use App\Models\Tblfee;
class SettingsController extends Controller
{
    //
    public function create(){
        $optionlist=Tblsystemoption::select()->get();
        $opdat=[];
        $optd['optionlist']=$optionlist;
        //dd($optionlist);
        //load fees
        $fees=Tblfee::all();
        //load other options
        $optionlist=DB::table('tblsystemoption')->get();
        //get values for each option table
        $opdat=[];
        //get values for each table and store in opdat array
        foreach($optionlist as $option){
            $tbl=$option->tblname;
            $vals=DB::table($tbl)->get();
            $opdat[$tbl]=$vals;
        }
        
        return view('admin.settings',['optionlist'=>$optionlist,
        'opdat'=>$opdat,'fees'=>$fees]);
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
    public function modifyfee(Request $request){
        $feeid=$request->get('feeid');
        if($feeid>0)
            Tblfee::where('id',$feeid)->update($request->except(['_csrf','_token','_method','feeid']));
        else if($feeid==-1)
        {
            $fee=new Tblfee();
            $fee->fill($request->except(['_csrf','_token','_method','feeid']));
            $fee->save();
        }
        return redirect()->back()->with('success',"Fee Added successfully");
    }
    public function deleteFee(Request $request){
        $feeid=$request->get('rem_feeid');
        Tblfee::find($feeid)->delete();
        return redirect()->route('settings')->with('success','fee deleted');
    }
}
