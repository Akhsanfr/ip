<?php

namespace App\Http\Livewire;

use App\Models\Instansi;
use Livewire\Component;

class InstansiView extends Component
{
    public $instansis;

    public function mount(){
        $this->instansis = Instansi::all();
        // dd($this->instansis);
    }

    public function render()
    {
        return view('livewire.instansi-view');
    }
}
