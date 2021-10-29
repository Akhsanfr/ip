<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
// use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;

class AuthController extends Controller
{

    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function proses(){
        // Ambil data user dari google
        $user = Socialite::driver('google')->stateless()->user();
        // $user = Socialite::driver('google')->user();

        $user_data = $user->user;
        // dd($user_data);
        // Cek email pkn stan
        // if( isset($user_data['hd']) && ($user_data['hd'] == 'pknstan.ac.id')){
        //     $email = $user_data['email'];
        //     $npm = explode('_',$email)[0];
        //     // Cek email manset 18
        //     if(preg_match("/430218/i", $npm)){

        //     } else {
        //         $this->flash_data('warning','Maaf, website ini hanya mengakomodir mahasiswa Manajemen Aset angkatan 2018');
        //         return view('guest');
        //     }
        // } else {
        //     $this->flash_data('danger','Gunakan alamat gmail dengan domain pknstan.ac.id');
        //     return view('guest');
        // }

        // cocokan dengan database
        $user_lama = User::with('kelas')->where('google_id', $user->id)->first();
        // dd($user_lama->kelas->kelas);
        if(!empty($user_lama)){
            session(['user' => $user_lama]);
            return redirect(route('dashboard'));
        } elseif(session('changeEmail')) {
            $user = session('user');
            $user->google_id = $user_data['id'];
            $user->email = $user_data['email'];
            $user->avatar = $user_data['picture'];
            $user->save();
            session(['user' => $user]);
            session()->forget('changeEmail');
            session()->flash('pesan', 'Email berhasil diubah');
            return redirect(route('dashboard'));
        } else {
            $this->flash_data('warning','Maaf, untuk saat ini website hanya bisa diakses oleh pengguna yang telah terdaftar');
            return view('guest');
        }
    }

    public function changeEmail(){
        session(['changeEmail' => true]);
        return Socialite::driver('google')->redirect();
    }

    public function logout(){
        session()->forget('user');
        return redirect(route('guest'));
    }
}
