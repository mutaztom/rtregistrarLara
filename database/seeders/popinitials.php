<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tblqualdegree;
use App\Models\Tblqualtype;

class popinitials extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run():void{
    //     Tblqualdegree::insert(['item'=>'Bachlor', 'aritem'=>'البكالوريوس', 'forfeild'=>0,'mainid'=> 1]);
    //     Tblqualdegree::insert(['item'=>'Master','aritem'=>'الماجستير','forfeild'=> 0, 'mainid'=>1]);
    //     Tblqualdegree::insert(['item'=>'PhD','aritem'=> 'الدكتوراه', 'forfeild'=>0, 'mainid'=>1]);
    //     Tblqualdegree::insert(['item'=>'Diploma','aritem'=> 'الديبلوما','forfeild'=> 0,'mainid'=> 1]);
    //     Tblqualdegree::insert(['item'=>'Certificate','aritem'=> 'الشهادة','forfeild'=> 0,'mainid'=> 1]);
    //     Tblqualdegree::insert(['item'=>'High Diploma','aritem'=> 'دبلوما عليا','forfeild'=> 0,'mainid'=> 1]);
    // }
    public function run(){
        Tblqualtype::create(['item'=>'Academic Deree','aritem'=>'الدرجة العلمية','forfeild'=>0,'mainid'=>0]);
        Tblqualtype::create(['item'=>'Certificate','aritem'=>'كورس','forfeild'=>0,'mainid'=>0]);
        Tblqualtype::create(['item'=>'Training','aritem'=>'تدريب','forfeild'=>0,'mainid'=>0]);
        Tblqualtype::create(['item'=>'Experience','aritem'=>'خبرة','forfeild'=>0,'mainid'=>0]);
        Tblqualtype::create(['item'=>'CV','aritem'=>'سيرة ذاتية','forfeild'=>0,'mainid'=>0]);
    }
}
