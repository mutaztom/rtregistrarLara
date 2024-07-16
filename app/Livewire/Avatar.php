<?php

namespace App\Livewire;

use Livewire\Component;

class Avatar extends Component
{
    use WithFileUploads;
 
    #[Validate('image|max:1024')] // 1MB Max
    public $photo;

    public function render()
    {
        return view('livewire.avatar');
    }
    public function save(){
        
    $this->photo->store(path: 'public/avatars/');
    }
}
<