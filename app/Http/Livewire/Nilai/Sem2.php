<?php

namespace App\Http\Livewire\Nilai;

use Livewire\Component;
use App\Models\NilaiSemDua;

class Sem2 extends Component
{
    public $user;

    protected $rules = [
        'user.user_id' => 'required',
        'user.pancasila' => 'required|numeric|min:1|max:4',
        'user.bing' => 'required|numeric|min:1|max:4',
        'user.mikro' => 'required|numeric|min:1|max:4',
        'user.pajak' => 'required|numeric|min:1|max:4',
        'user.ppkn' => 'required|numeric|min:1|max:4',
        'user.pengakun2' => 'required|numeric|min:1|max:4',
        'user.hukperus' => 'required|numeric|min:1|max:4',
        'user.hukper' => 'required|numeric|min:1|max:4',
        'user.piutang' => 'required|numeric|min:1|max:4',
    ];

    public function update(){

        $this->validate();

        bcscale(100);
        $pancasila = bcmul($this->user->pancasila, 2);
        $bing = bcmul($this->user->bing, 2);
        $mikro = bcmul($this->user->mikro, 3);
        $pajak = bcmul($this->user->pajak, 3);
        $ppkn = bcmul($this->user->ppkn, 2);
        $pengakun2 = bcmul($this->user->pengakun2, 3);
        $hukperus = bcmul($this->user->hukperus, 2);
        $hukper = bcmul($this->user->hukper, 3);
        $piutang = bcmul($this->user->piutang, 3);

        $sks = 23;
        $jumlah_nilai = bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd($pancasila, $bing),$mikro),$pajak),$ppkn), $pengakun2),$hukperus),$hukper),$piutang);
        $this->user->ip = bcdiv($jumlah_nilai, $sks);
        $this->user->save();
        $this->emit('alert', ['success', 'Perubahan data telah tersimpan']);
        return redirect(route('dashboard'));
    }
    public function mount(){
        if(!$this->user = NilaiSemDua::where('user_id', session('user')->id)->first()){
            $this->user = new NilaiSemDua();
            $this->user->user_id = session('user')->id;
        };
    }

    public function render()
    {
        return view('livewire.nilai.sem2');
    }
}
