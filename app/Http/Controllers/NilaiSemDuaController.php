<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NilaiSemDua;

class NilaiSemDuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sem2.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->skala();
        $user = User::find(session('user')->id);
        $validated = $request->validate([
            'pancasila' => 'required|numeric|min:1|max:4',
            'bing' => 'required|numeric|min:1|max:4',
            'mikro' => 'required|numeric|min:1|max:4',
            'pajak' => 'required|numeric|min:1|max:4',
            'ppkn' => 'required|numeric|min:1|max:4',
            'pengakun2' => 'required|numeric|min:1|max:4',
            'hukperus' => 'required|numeric|min:1|max:4',
            'hukper' => 'required|numeric|min:1|max:4',
            'piutang' => 'required|numeric|min:1|max:4',
        ]);

        $pancasila = bcmul($request->pancasila, 2);
        $bing = bcmul($request->bing, 2);
        $mikro = bcmul($request->mikro, 3);
        $pajak = bcmul($request->pajak, 3);
        $ppkn = bcmul($request->ppkn, 2);
        $pengakun2 = bcmul($request->pengakun2, 3);
        $hukperus = bcmul($request->hukperus, 2);
        $hukper = bcmul($request->hukper, 3);
        $piutang = bcmul($request->piutang, 3);

        $sks = 23;
        $jumlah_nilai = bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd($pancasila, $bing),$mikro),$pajak),$ppkn), $pengakun2),$hukperus),$hukper),$piutang);
        $ip = $jumlah_nilai / $sks;
        $validated += ['ip'=> $ip];
        $user->nilaiSemDua()->create($validated);
        $this->flash_data('success','Data nilai semester 2 berhasil disimpan');
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id != session('user')->id)
        {
            return redirect(route('home'));
        }
        $nilai = NilaiSemDua::where('user_id', $id)->first();
        return view('sem2.edit', compact('nilai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->skala();
        $validated = $request->validate([
            'pancasila' => 'required|numeric|min:1|max:4',
            'bing' => 'required|numeric|min:1|max:4',
            'mikro' => 'required|numeric|min:1|max:4',
            'pajak' => 'required|numeric|min:1|max:4',
            'ppkn' => 'required|numeric|min:1|max:4',
            'pengakun2' => 'required|numeric|min:1|max:4',
            'hukperus' => 'required|numeric|min:1|max:4',
            'hukper' => 'required|numeric|min:1|max:4',
            'piutang' => 'required|numeric|min:1|max:4',
        ]);

        $pancasila = bcmul($request->pancasila, 2);
        $bing = bcmul($request->bing, 2);
        $mikro = bcmul($request->mikro, 3);
        $pajak = bcmul($request->pajak, 3);
        $ppkn = bcmul($request->ppkn, 2);
        $pengakun2 = bcmul($request->pengakun2, 3);
        $hukperus = bcmul($request->hukperus, 2);
        $hukper = bcmul($request->hukper, 3);
        $piutang = bcmul($request->piutang, 3);

        $sks = 23;
        $jumlah_nilai = bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd($pancasila, $bing),$mikro),$pajak),$ppkn), $pengakun2),$hukperus),$hukper),$piutang);
        $ip = $jumlah_nilai / $sks;
        $validated += ['ip'=> $ip];
        NilaiSemDua::where('user_id', $id)->update($validated);
        $this->flash_data('success','Data nilai semester 2 berhasil diperbarui');
        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
