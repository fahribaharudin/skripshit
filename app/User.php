<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
    }

    public function kuisioner()
    {
        return $this->hasMany(Kuisioner::class);
    }

    public function hasRole($roleName)
    {
        foreach ($this->roles as $role) {
            if ($roleName == $role->role_name) {
                return true;
            }
        }

        return false;
    }

    public function getDokumenTestFromKuisioner()
    {
        $dokumentTest = new \stdClass();
        foreach ($this->kuisioner as $kuisioner) {
            switch ($kuisioner->pertanyaan) {
                case 'jumlah_organisasi':
                    $dokumentTest->jumlah_organisasi = $kuisioner->jawaban;
                case 'waktu_berorganisasi_dalam_sehari':
                    $dokumentTest->waktu_berorganisasi = $kuisioner->jawaban;
                case 'sudah_kp_atau_kpm':
                    $dokumentTest->sudah_kp_atau_kpm = $kuisioner->jawaban;
                case 'event_organisasi_tiap_semester':
                    $dokumentTest->event_organisasi_tiap_semester = $kuisioner->jawaban;
                case 'pernah_jadi_panitia':
                    $dokumentTest->jadi_panitia = $kuisioner->jawaban;
                case 'mata_kuliah_belum_tuntas':
                    $dokumentTest->makul_belum_tuntas = $kuisioner->jawaban;
                case 'sks_cukup':
                    $dokumentTest->sks_cukup = $kuisioner->jawaban;
                case 'ingin_lulus_tepat_waktu':
                    $dokumentTest->ingin_lulus_tepat_waktu = $kuisioner->jawaban;
            }
        }

        return $dokumentTest;
    }

    public function makePrediksiKelulusan()
    {
        $classifier = new NBCClassifier($this->getDokumenTestFromKuisioner());

        return $classifier->classify();
    }
}
