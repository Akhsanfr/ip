<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NilaiSemSatuController;
use App\Http\Controllers\NilaiSemDuaController;
use App\Http\Controllers\NilaiSemTigaController;
use App\Http\Controllers\NilaiSemEmpatController;
use App\Http\Controllers\NilaiSemLimaController;
use App\Http\Controllers\NilaiSemEnamController;
use App\Http\Controllers\SkdController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Instansi;
use App\Http\Livewire\InstansiEdit;
use App\Http\Livewire\InstansiView;
use App\Http\Livewire\Nilai\Sem1;
use App\Http\Livewire\Nilai\Sem2;
use App\Http\Livewire\Nilai\Sem3;
use App\Http\Livewire\Nilai\Sem4;
use App\Http\Livewire\Nilai\Sem5;
use App\Http\Livewire\Nilai\Sem6;
use App\Http\Livewire\Nilai\Skd;
use App\Models\NilaiSemDua;
use App\Models\NilaiSemEnam;

// Route::get('/', function(){
//     return view('maintenance');
// });
// Route::get('/{i}', function(){
//     return view('maintenance');
// });
Route::get('/', Dashboard::class)->name('dashboard')->middleware('user');
Route::get('/instansi', Instansi::class)->name('instansi')->middleware(['user', 'admin']);
Route::get('/instansi/edit/{id}', InstansiEdit::class)->name('instansi.edit')->middleware(['user', 'admin']);
Route::get('/instansi/view', InstansiView::class)->name('instansi.view')->middleware('user');

Route::get('/guest', function(){return view('guest');})->name('guest');
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.login');
Route::get('/auth/callback', [AuthController::class, 'proses']);
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth/change-email', [AuthController::class, 'changeEmail'])->name('auth.change-email');


Route::get('/nilai-satu', Sem1::class)->middleware('user');
Route::get('/nilai-dua', Sem2::class)->middleware('user');
Route::get('/nilai-tiga', Sem3::class)->middleware('user');
Route::get('/nilai-empat', Sem4::class)->middleware('user');
Route::get('/nilai-lima', Sem5::class)->middleware('user');
Route::get('/nilai-enam', Sem6::class)->middleware('user');
Route::get('/nilai-skd', Skd::class)->middleware('user');

Route::get('/gen-sem-dua', function(){
    $datas = NilaiSemDua::all();
    foreach($datas as $data){
        $id = $data->id;
        $nilai_user = NilaiSemDua::find($id);

        bcscale(100);
        $pancasila = bcmul($data->pancasila, 2);
        $bing = bcmul($data->bing, 2);
        $mikro = bcmul($data->mikro, 3);
        $pajak = bcmul($data->pajak, 3);
        $ppkn = bcmul($data->ppkn, 2);
        $pengakun2 = bcmul($data->pengakun2, 3);
        $hukperus = bcmul($data->hukperus, 2);
        $hukper = bcmul($data->hukper, 3);
        $piutang = bcmul($data->piutang, 3);

        $sks = 23;
        $jumlah_nilai = bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd(bcadd($pancasila, $bing),$mikro),$pajak),$ppkn), $pengakun2),$hukperus),$hukper),$piutang);
        $nilai_user->ip = bcdiv($jumlah_nilai, $sks);
        $nilai_user->save();
    }

})->middleware(['user', 'admin']);

Route::get('/gen-sem-enam', function(){
    $datas = NilaiSemEnam::all();
    foreach($datas as $data){
        $id = $data->id;
        $nilai_user = NilaiSemEnam::find($id);

        bcscale(100);
        $pu2 = bcmul($data->pu2, 3);
        $manris = bcmul($data->manris, 2);
        $etikor = bcmul($data->etikor, 3);
        $bnpk = bcmul($data->bnpk, 3);
        $ktta = bcmul($data->ktta, 2);

        $sks = 13;
        $jumlah_nilai = bcadd(bcadd(bcadd(bcadd($pu2, $manris),$etikor),$bnpk),$ktta);
        $nilai_user->ip = bcdiv($jumlah_nilai, $sks);
        $nilai_user->save();
    }

})->middleware(['user', 'admin']);
