<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class membership extends Component
{
        public $regid;
        public $mships;
        public array $associations = [];
        public bool $creating = false;
    /**
     * Create a new component instance.
     */
    public function __construct(public $value,
    
   ) 
    {
        //
          
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->$associations=DB::table('tblassociations')->select('id','item')->pluck()->json_encode() ;

        return view('components.membership',['associations'=>$this->$associations]);
    }
    public function associations(){
        return $this->associations;
    }
}
