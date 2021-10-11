<?php

namespace App\Http\Livewire;

use App\Models\Aktif;
use App\Models\Instansi;
use Livewire\Component;
use App\Models\User;
use App\Models\NilaiSemSatu;
use App\Models\NilaiSemDua;
use App\Models\NilaiSemTiga;
use App\Models\NilaiSemEmpat;
use App\Models\NilaiSemLima;
use App\Models\NilaiSemEnam;
use App\Models\PilihanSatu;
use App\Models\PilihanDua;
use App\Models\PilihanTiga;
use App\Models\skd;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class Dashboard extends Component
{
    public $user;
    public $user_kelas;
    public $data;
    // IPK all partisipan
    public $ipk_saya;
    public $ipk_saya_rank;
    public $skd_saya;
    public $skd_saya_rank;
    public $nilai_gabungan_saya;
    public $nilai_gabungan_saya_rank;
    // Available instansis
    public $instansis;
    // Pilihan user di DB
    public $pilihan_satu;
    public $pilihan_dua;
    public $pilihan_tiga;
    // Count pemilih instansi
    public $jumlah_instansi_satu;
    public $jumlah_instansi_dua;
    public $jumlah_instansi_tiga;
    // Izin update
    public $update;
    // pesan
    public $pesan;
    // Count Instansi
    public $count_instansi;
    public $prioritas_instansi;
    public $proporsi_ipk = 0.6;
    public $proporsi_skd = 0.4;


    protected $rules = [
        'pilihan_satu.instansi_id' => 'required',
        'pilihan_dua.instansi_id' => 'required',
        'pilihan_tiga.instansi_id' => 'required',
        'count_instansi' => 'required',
    ];

    // Pilih Instansi

    public function pilihan_satu($id){
        if($this->update){
            $this->pilihan_satu->instansi_id = $id;
            $this->pilihan_satu->save();
            $this->mount();
        } else {
            $this->emit('alert', ['error', 'Maaf, masa perubahan data telah usai.']);
        }
    }
    public function pilihan_dua($id){
        if($this->update){
            $this->pilihan_dua->instansi_id = $id;
            $this->pilihan_dua->save();
            $this->mount();
        } else {
            $this->emit('alert', ['error', 'Maaf, masa perubahan data telah usai.']);
        }
    }
    public function pilihan_tiga($id){
        if($this->update){
            $this->pilihan_tiga->instansi_id = $id;
            $this->pilihan_tiga->save();
            $this->mount();
        } else {
            $this->emit('alert', ['error', 'Maaf, masa perubahan data telah usai.']);
        }
    }
    // Proprsi Final
    public function proporsi_ipk($ipk){
        $this->proporsi_ipk = bcdiv($ipk,10, 100);
        $this->proporsi_skd = bcsub(1, $this->proporsi_ipk, 100);
        $this->nilai_gabungan_saya = $this->ubah_ipk_skd($this->ipk_saya, $this->skd_saya);
    }
    public function proporsi_skd($skd){
        $this->proporsi_skd = bcdiv($skd,10, 100);
        $this->proporsi_ipk = bcsub(1, $this->proporsi_skd, 100);
        $this->nilai_gabungan_saya = $this->ubah_ipk_skd($this->ipk_saya, $this->skd_saya);
    }

    public function ubah_anonim(){
        $this->user->is_anonim = !$this->user->is_anonim;
        $this->user->save();
    }


    // Count Instansi

    public function show_instansi($pilihan){
        if($pilihan == 'pilihan_satus'){
            if($this->pilihan_satu->instansi_id == null){
                $this->emit('alert', ['error', 'Maaf, silakan kamu memilih intansi terlebih dahulu.']);
                return false;
            }
            $this->prioritas_instansi = 'Pilihan pertama';
            $pilihan_saya = $this->pilihan_satu->instansi->nama;
        } elseif($pilihan == 'pilihan_duas'){
            if($this->pilihan_dua->instansi_id == null){
                $this->emit('alert', ['error', 'Maaf, silakan kamu memilih intansi terlebih dahulu.']);
                return false;
            }
            $this->prioritas_instansi = 'Pilihan kedua';
            $pilihan_saya = $this->pilihan_dua->instansi->nama;
        } else {
            if($this->pilihan_tiga->instansi_id == null){
                $this->emit('alert', ['error', 'Maaf, silakan kamu memilih intansi terlebih dahulu.']);
                return false;
            }
            $this->prioritas_instansi = 'Pilihan ketiga';
            $pilihan_saya = $this->pilihan_tiga->instansi->nama;
        }
        $this->count_instansi = Instansi::with($pilihan.'.user')->withCount([$pilihan.' as jumlah'])->orderByDesc('jumlah')->get();
        $data_pemilih = [];
        $ipk_pemilih = [];
        for($i = 0; $i < count($this->count_instansi); $i++){
            if($pilihan === 'pilihan_satus'){
                $pilihan_instansi = $this->count_instansi[$i]->pilihan_satus;
            } elseif($pilihan === 'pilihan_duas') {
                $pilihan_instansi = $this->count_instansi[$i]->pilihan_duas;
                $pilihan_instansi = $this->count_instansi[$i]->pilihan_duas;
            } elseif($pilihan === 'pilihan_tigas') {
                $pilihan_instansi = $this->count_instansi[$i]->pilihan_tigas;
            } else {
                dd($pilihan);
            }
            $data_pemilih_per_instansi = [];
            $ipk_pemilih_per_instansi = [];
            foreach($pilihan_instansi as $user){
                if($user->user->is_anonim){
                    array_push($data_pemilih_per_instansi, 'anonim');
                } else {
                    array_push($data_pemilih_per_instansi, $user->user->name);
                    // skd * 100% / 500
                }
                // $nilai_skd_100 = bcdiv($user->user->skd->skd ?? 0,500,100); // nilai dalam rentang 1-100
                // $nilai_ipk_100 = bcdiv($user->user->ipk, 4, 100);
                // $nilai_skd_proporsi = bcmul($this->proporsi_skd, $nilai_skd_100, 100);
                // $nilai_ipk_proporsi = bcmul($this->proporsi_ipk, $nilai_ipk_100, 100);
                // $nilai_gabungan_final = bcadd($nilai_ipk_proporsi, $nilai_skd_proporsi, 100);
                // $nilai_gabungan_final = bcmul($nilai_gabungan_final, 100, 100); // buat rentang 0 - 100
                $nilai_gabungan_final = $this->ubah_ipk_skd($user->user->ipk, $user->user->skd->skd ?? 0);
                array_push($ipk_pemilih_per_instansi, $nilai_gabungan_final);
            }
            sort($data_pemilih_per_instansi);
            sort($ipk_pemilih_per_instansi);
            array_push($data_pemilih,$data_pemilih_per_instansi);
            array_push($ipk_pemilih,$ipk_pemilih_per_instansi);

        }
        $this->dispatchBrowserEvent('count_instansi_update', [
            'data' => $this->count_instansi,
            'data_pemilih' => $data_pemilih,
            'ipk_pemilih' => $ipk_pemilih,
            'pilihan_saya' => $pilihan_saya,
            'ipk_saya' => $this->ubah_ipk_skd($this->ipk_saya, $this->skd_saya),
        ]);
    }
    public function close_instansi(){
        $this->count_instansi = null;
    }
    public function ubah_ipk_skd($ipk, $skd){
        $nilai_skd_100 = bcdiv($skd ?? 0,500,100); // nilai dalam rentang 1-100
        $nilai_ipk_100 = bcdiv($ipk, 4, 100); // nilai dalam rentang 1 - 100
        $nilai_skd_proporsi = bcmul($this->proporsi_skd, $nilai_skd_100, 100);
        $nilai_ipk_proporsi = bcmul($this->proporsi_ipk, $nilai_ipk_100, 100);
        $nilai_gabungan_final = bcadd($nilai_ipk_proporsi, $nilai_skd_proporsi, 100);
        return bcmul($nilai_gabungan_final, 100, 100); // buat rentang 0 - 100
    }

    public function mount(){


        if(is_null(session('user'))){
            return redirect(route('guest'));
        }

        $this->user = User::find(session('user')->id);
        $this->user_kelas = session('user')->kelas->kelas;



        // Cek DB dan isi jika belom ada data pilihan

        $this->pilihan_satu = PilihanSatu::where('user_id', session('user')->id)->first() ?? PilihanSatu::create([
            'user_id' => session('user')->id,
        ]);
        $this->pilihan_dua = PilihanDua::where('user_id', session('user')->id)->first() ?? PilihanDua::create([
            'user_id' => session('user')->id,
        ]);
        $this->pilihan_tiga = PilihanTiga::where('user_id', session('user')->id)->first() ?? PilihanTiga::create([
            'user_id' => session('user')->id,
        ]);

        // Get availabel instansi
        $this->instansis = Instansi::orderBy('nama')->get();
        // Hitung pemilih instansi sesuai instansi pilihan user
        if($this->pilihan_satu->instansi_id != null){
            $this->jumlah_instansi_satu = Instansi::withCount('pilihan_satus')
                ->where('id', $this->pilihan_satu->instansi_id)
                ->first()->pilihan_satus_count;
        }
        if($this->pilihan_dua->instansi_id != null){
            $this->jumlah_instansi_dua = Instansi::withCount('pilihan_duas')
                ->where('id', $this->pilihan_dua->instansi_id)
                ->first()->pilihan_duas_count;
        }
        if($this->pilihan_tiga->instansi_id != null){
            $this->jumlah_instansi_tiga = Instansi::withCount('pilihan_tigas')
                ->where('id', $this->pilihan_tiga->instansi_id)
                ->first()->pilihan_tigas_count;
        }

        // Izinkan update
        $this->update = Aktif::where('nama', 'update pilihan')->first()->is_active;

        // Array data yang akan dikirim ke view
        $this->data = [];

        // --- SEMESTER 1 ---

        // Ambil tabel nilai semester 1, return objek
        $id = session('user')->id;
        $nilai_sem_satu = $this->user->nilaiSemSatu()->first();
        $this->data += compact('nilai_sem_satu');

        // Cek, jika ada nilai semester satu maka hitung rata-rata angkatan dan ranking user
        if(isset($nilai_sem_satu)){
            $nilai_sem_satu = $nilai_sem_satu->ip;
            $rata_sem_satu = NilaiSemSatu::avg('ip');
            $nilai_all_sem_satu = NilaiSemSatu::orderBy('ip', 'desc')->pluck('ip')->toArray();
            $rank_sem_satu = array_search($nilai_sem_satu, $nilai_all_sem_satu) + 1;
            $partisipan_sem_satu = NilaiSemSatu::count();

            $this->data += compact(
                'rata_sem_satu',
                'rank_sem_satu',
                'partisipan_sem_satu'
            );
            // Ubah data objek nilai semester satu menjadi angka
            $this->data['nilai_sem_satu'] = $nilai_sem_satu;
        }

        // --- SEMESTER 2 ---

        // Ambil tabel nilai semester 2, return objek
        $id = session('user')->id;
        $nilai_sem_dua = $this->user->nilaiSemDua()->first();
        $this->data += compact('nilai_sem_dua');

        // Cek, jika ada nilai semester dua maka hitung rata-rata angkatan dan ranking user
        if(isset($nilai_sem_dua)){
            $nilai_sem_dua = $nilai_sem_dua->ip;
            $rata_sem_dua = NilaiSemDua::avg('ip');
            $nilai_all_sem_dua = NilaiSemDua::orderBy('ip', 'desc')->pluck('ip')->toArray();
            $rank_sem_dua = array_search($nilai_sem_dua, $nilai_all_sem_dua) + 1;
            $partisipan_sem_dua = NilaiSemDua::count();
            // Tambahkan data rata-rata dan ranking
            $this->data += compact(
                'rata_sem_dua',
                'rank_sem_dua',
                'partisipan_sem_dua'
            );
            // Ubah data objek nilai semester dua menjadi angka
            $this->data['nilai_sem_dua'] = $nilai_sem_dua;
        }

        // --- SEMESTER 3 ---

        // Ambil tabel nilai semester 3, return objek
        $id = session('user')->id;
        $nilai_sem_tiga = $this->user->nilaiSemTiga()->first();
        $this->data += compact('nilai_sem_tiga');

        // Cek, jika ada nilai semester tiga maka hitung rata-rata angkatan dan ranking user
        if(isset($nilai_sem_tiga)){
            $nilai_sem_tiga = $nilai_sem_tiga->ip;
            $rata_sem_tiga = NilaiSemTiga::avg('ip');
            $nilai_all_sem_tiga = NilaiSemTiga::orderBy('ip', 'desc')->pluck('ip')->toArray();
            $rank_sem_tiga = array_search($nilai_sem_tiga, $nilai_all_sem_tiga) + 1;
            $partisipan_sem_tiga = NilaiSemTiga::count();
            // Tambahkan data rata-rata dan ranking
            $this->data += compact(
                'rata_sem_tiga',
                'rank_sem_tiga',
                'partisipan_sem_tiga'
            );
            // Ubah data objek nilai semester tiga menjadi angka
            $this->data['nilai_sem_tiga'] = $nilai_sem_tiga;
        }

        // --- SEMESTER 4 ---

        // Ambil tabel nilai semester 4, return objek
        $id = session('user')->id;
        $nilai_sem_empat = $this->user->nilaiSemEmpat()->first();
        $this->data += compact('nilai_sem_empat');

        // Cek, jika ada nilai semester empat maka hitung rata-rata angkatan dan ranking user
        if(isset($nilai_sem_empat)){
            $nilai_sem_empat = $nilai_sem_empat->ip;
            $rata_sem_empat = NilaiSemEmpat::avg('ip');
            $nilai_all_sem_empat = NilaiSemEmpat::orderBy('ip', 'desc')->pluck('ip')->toArray();
            $rank_sem_empat = array_search($nilai_sem_empat, $nilai_all_sem_empat) + 1;
            $partisipan_sem_empat = NilaiSemEmpat::count();
            // Tambahkan data rata-rata dan ranking
            $this->data += compact(
                'rata_sem_empat',
                'rank_sem_empat',
                'partisipan_sem_empat'
            );
            // Ubah data objek nilai semester empat menjadi angka
            $this->data['nilai_sem_empat'] = $nilai_sem_empat;
        }

        // --- SEMESTER 5 ---

        // Ambil tabel nilai semester 5, return objek
        $id = session('user')->id;
        $nilai_sem_lima = $this->user->nilaiSemLima()->first();
        $this->data += compact('nilai_sem_lima');

        // Cek, jika ada nilai semester lima maka hitung rata-rata angkatan dan ranking user
        if(isset($nilai_sem_lima)){
            $nilai_sem_lima = $nilai_sem_lima->ip;
            $rata_sem_lima = NilaiSemLima::avg('ip');
            $nilai_all_sem_lima = NilaiSemLima::orderBy('ip', 'desc')->pluck('ip')->toArray();
            $rank_sem_lima = array_search($nilai_sem_lima, $nilai_all_sem_lima) + 1;
            $partisipan_sem_lima = NilaiSemLima::count();
            // Tambahkan data rata-rata dan ranking
            $this->data += compact(
                'rata_sem_lima',
                'rank_sem_lima',
                'partisipan_sem_lima'
            );
            // Ubah data objek nilai semester lima menjadi angka
            $this->data['nilai_sem_lima'] = $nilai_sem_lima;
        }

        // --- SEMESTER 6 ---

        // Ambil tabel nilai semester 6, return objek
        $id = session('user')->id;
        $nilai_sem_enam = $this->user->nilaiSemEnam()->first();
        $this->data += compact('nilai_sem_enam');

        // Cek, jika ada nilai semester enam maka hitung rata-rata angkatan dan ranking user
        if(isset($nilai_sem_enam)){
            $nilai_sem_enam = $nilai_sem_enam->ip;
            $rata_sem_enam = NilaiSemEnam::avg('ip');
            $nilai_all_sem_enam = NilaiSemEnam::orderBy('ip', 'desc')->pluck('ip')->toArray();
            $rank_sem_enam = array_search($nilai_sem_enam, $nilai_all_sem_enam) + 1;
            $partisipan_sem_enam = NilaiSemEnam::count();
            // Tambahkan data rata-rata dan ranking
            $this->data += compact(
                'rata_sem_enam',
                'rank_sem_enam',
                'partisipan_sem_enam'
            );
            // Ubah data objek nilai semester enam menjadi angka
            $this->data['nilai_sem_enam'] = $nilai_sem_enam;
        }

        // --- SKD ---

        // Ambil tabel nilai skd, return objek
        $id = session('user')->id;
        $nilai_skd = $this->user->skd()->first();
        $this->data += compact('nilai_skd');

        // Cek, jika ada skd maka hitung rata-rata angkatan dan ranking user
        if(isset($nilai_skd)){
            $nilai_skd = $nilai_skd->skd;
            $rata_skd = skd::avg('skd');
            $nilai_all_skd = skd::orderBy('skd', 'desc')->pluck('skd')->toArray();
            $rank_skd = array_search($nilai_skd, $nilai_all_skd) + 1;
            $partisipan_skd = skd::count();
            // Tambahkan data rata-rata dan ranking
            $this->data += compact(
                'rata_skd',
                'rank_skd',
                'partisipan_skd'
            );
            // Ubah data objek skd menjadi angka
            $this->data['nilai_skd'] = $nilai_skd;



        }



        // IPK

        // Recek nilai IPK
        bcscale(100);
        $ip_1 = bcmul($this->data['nilai_sem_satu'] ?? 0,  19 );
        $ip_2 = bcmul($this->data['nilai_sem_dua'] ??0 , 23 );
        $ip_3 = bcmul($this->data['nilai_sem_tiga'] ??0 , 23 );
        $ip_4 = bcmul($this->data['nilai_sem_empat'] ??0 , 23 );
        $ip_5 = bcmul($this->data['nilai_sem_lima'] ??0 , 18 );
        $ip_6 = bcmul($this->data['nilai_sem_enam'] ??0 , 16 );
        $jumlah_ip = bcadd($ip_1,bcadd($ip_2,bcadd($ip_3, bcadd($ip_4, bcadd($ip_5,$ip_6 )))));
        $this->user->ipk = bcdiv($jumlah_ip, 122);
        $this->user->save();

        // Show nilai IPK

        $this->ipk_saya = $this->user->ipk;
        $this->ipk_saya_rank = User::orderByDesc('ipk')->pluck('ipk')->search($this->ipk_saya) + 1;
        $this->skd_saya = skd::where('user_id', $this->user->id)->first()->skd ?? 0;
        if($this->skd_saya){
            $this->skd_saya_rank = skd::orderByDesc('skd')->pluck('skd')->search($this->skd_saya)  +1;
        } else {
            $this->skd_saya_rank = '-';
        }
        $this->nilai_gabungan_saya = $this->ubah_ipk_skd($this->ipk_saya, $this->skd_saya);

        // Get data partisipan per kelas
        $this->data['partisipan_sem_satu_kelas'] = $this->getJumlahPartisipanNilaiPerKelas('nilai_sem_satus');
        $this->data['partisipan_sem_dua_kelas'] = $this->getJumlahPartisipanNilaiPerKelas('nilai_sem_duas');
        $this->data['partisipan_sem_tiga_kelas'] = $this->getJumlahPartisipanNilaiPerKelas('nilai_sem_tigas');
        $this->data['partisipan_sem_empat_kelas'] = $this->getJumlahPartisipanNilaiPerKelas('nilai_sem_empats');
        $this->data['partisipan_sem_lima_kelas'] = $this->getJumlahPartisipanNilaiPerKelas('nilai_sem_limas');
        $this->data['partisipan_sem_enam_kelas'] = $this->getJumlahPartisipanNilaiPerKelas('nilai_sem_enams');
        $this->data['partisipan_skd_kelas'] = $this->getJumlahPartisipanNilaiPerKelas('skds');

        $this->data['partisipan_pilihan_satu_kelas'] = $this->getJumlahPartisipanPilihanPerKelas('pilihan_satus');
        $this->data['partisipan_pilihan_dua_kelas'] = $this->getJumlahPartisipanPilihanPerKelas('pilihan_duas');
        $this->data['partisipan_pilihan_tiga_kelas'] = $this->getJumlahPartisipanPilihanPerKelas('pilihan_tigas');
    }
    public function flash_data($tipe, $isi){
        session()->flash('pesan_tipe',"$tipe");
        session()->flash('pesan_isi',"$isi");
    }

    public function getJumlahPartisipanNilaiPerKelas($tabel){
        return DB::table($tabel)
                ->join('users',$tabel.'.user_id', '=', 'users.id')
                ->join('kelas', 'kelas.npm', '=', 'users.npm')
                ->where('kelas', $this->user_kelas)
                ->count();
    }
    public function getJumlahPartisipanPilihanPerKelas($tabel){
        return DB::table($tabel)
                ->join('users',$tabel.'.user_id', '=', 'users.id')
                ->join('kelas', 'kelas.npm', '=', 'users.npm')
                ->where('kelas', $this->user_kelas)
                ->count();
    }
    public function render()
    {
        return view('livewire.dashboard')
        ;
    }
}
