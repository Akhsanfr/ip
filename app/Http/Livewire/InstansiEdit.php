<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Instansi;

class InstansiEdit extends Component
{

    public $instansi;

    protected $rules = [
        'instansi.nama' => 'required',
        'instansi.nama_singkatan' => 'required',
        'instansi.tipe' => 'required',
        'instansi.laman' => 'required',
        'instansi.alamat' => 'required',
        'instansi.kota' => 'required',
        'instansi.prov' => 'required',
        'instansi.jumlah_kantor' => 'required',
        'instansi.gb_sekitar_kantor' => 'required',
        'instansi.kuota_demand' => 'required',
        'instansi.kuota_mou' => 'required',
        'instansi.jabatan' => 'required',
        'instansi.gaji' => 'required',
        'instansi.umr' => 'required',
        'instansi.jarak_bandara' => 'required',
        'instansi.tubel' => 'required',
        'instansi.ibel' => 'required',
        'instansi.militer' => 'required',
        'instansi.jarak_ibukota_provinsi' => 'required',
        'instansi.gb_sebaran_kantor' => 'required',
        'instansi.ppt' => 'required',
        'instansi.yt' => 'required',
    ];

    public function mount($id){
        if($id==0){
            $this->instansi = new Instansi();
        } else {
            $this->instansi = Instansi::find($id);
        }
    }

    public function save(){
        $this->validate();
        $this->instansi->save();
        return redirect(route('instansi'));

    }

    public function render()
    {
        return view('livewire.instansi-edit');
    }
}
