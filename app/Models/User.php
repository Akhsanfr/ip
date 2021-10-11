<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function nilaiSemSatu()
    {
        return $this->hasOne(NilaiSemSatu::class);
    }
    public function nilaiSemDua()
    {
        return $this->hasOne(NilaiSemDua::class);
    }
    public function nilaiSemTiga()
    {
        return $this->hasOne(NilaiSemTiga::class);
    }
    public function nilaiSemEmpat()
    {
        return $this->hasOne(NilaiSemEmpat::class);
    }
    public function nilaiSemLima()
    {
        return $this->hasOne(NilaiSemLima::class);
    }
    public function nilaiSemEnam()
    {
        return $this->hasOne(NilaiSemEnam::class);
    }
    public function skd()
    {
        return $this->hasOne(skd::class);
    }
    public function instansis()
    {
        return $this->belongsToMany(Role::class);
    }
    public function kelas(){
        return $this->hasOne(Kelas::class, 'npm', 'npm');
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function admin(){
        foreach($this->roles as $role){
            if($role->nama == 'admin'){
                return true;
            }
        }
        return false;
    }

}
