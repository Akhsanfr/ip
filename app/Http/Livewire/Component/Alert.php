<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class Alert extends Component
{
    public $isi;
    public $class;
    public $tipe;

    protected $listeners = ['alert'];

    public function alert($pesan){
        $this->tipe = $pesan[0];
        $this->isi = $pesan[1];
        if($this->tipe == 'error'){
            $this->class = 'alert alert-error';
        } elseif($this->tipe == 'info'){
            $this->class = 'alert alert-info';
        }
    }

    public function close(){
        $this->isi = '';
    }

    public function render()
    {
        return view('livewire.component.alert');
    }
}
